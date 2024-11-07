<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invitacion;
use thiagoalessio\TesseractOCR\TesseractOCR;
use App\Models\GastoCompartido;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Log;


class GastoController extends Controller
{
    public function index()
    {
        // Definir categorías y sus iconos FontAwesome
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fas fa-tshirt',
            'decoracion' => 'fas fa-couch',
        ];

        // Obtener los gastos del usuario autenticado
        $gastos = Gasto::where('user_id', Auth::id())->get();

        // Pasar tanto los gastos como las categorías a la vista
        return view('gastos.dashboard', compact('gastos', 'categorias'));
    }
    

    public function create()
    {
        $user = Auth::user();
    
        // Definir categorías de ejemplo
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
            // Agrega más categorías según necesites
        ];
    

        
            // Recuperar usuarios con los que hay invitaciones aceptadas, evitando duplicados
            $usuarios = Invitacion::where(function ($query) use ($user) {
                                        $query->where('sender_id', $user->id)
                                              ->orWhere('receiver_id', $user->id);
                                    })
                                    ->where('status', 'aceptada')
                                    ->with('receiver', 'sender')
                                    ->get()
                                    ->map(function ($invitacion) use ($user) {
                                        return $invitacion->sender_id == $user->id ? $invitacion->receiver : $invitacion->sender;
                                    })
                                    ->unique('id'); // Asegura que no haya duplicados
        
            // Pasar tanto categorías como usuarios únicos a la vista
            return view('gastos.create', compact('categorias', 'usuarios'));
        
        
    }
    
    
    

    public function store(Request $request)
    {
        $user = Auth::user();
    
        // Crear el gasto
        $gasto = Gasto::create([
            'user_id' => $user->id,
            'nombre_gasto' => $request->nombre_gasto,
            'tipo' => $request->tipo,
            'valor' => $request->valor,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
        ]);
    
        // Si el gasto es compartido y hay usuarios seleccionados
        if ($request->has('es_compartido') && $request->filled('shared_with')) {
            foreach ($request->shared_with as $sharedWithUserId) {
                GastoCompartido::create([
                    'gasto_id' => $gasto->id,
                    'user_id' => $user->id, // El creador del gasto
                    'shared_with' => $sharedWithUserId, // Usuario con el que se comparte
                    'porcentaje' => 50, // Ajustable según tus necesidades
                ]);
            }
        }
    
        return redirect()->route('gastos.dashboard')->with('success', 'Gasto creado exitosamente.');
    }
    
    


    public function edit($id)
    {
        // Buscar el gasto por su ID
        $gasto = Gasto::findOrFail($id);
    
        // Definir las categorías y sus iconos
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
        ];
    
        // Retornar la vista de edición con los datos del gasto
        return view('gastos.edit', compact('gasto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos que llegan del formulario
        $validatedData = $request->validate([
            'nombre_gasto' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255',
        ]);

        // Encontrar el gasto por su ID
        $gasto = Gasto::findOrFail($id);

        // Actualizar el gasto con los nuevos valores
        $gasto->update($validatedData);

        // Redirigir al dashboard con un mensaje de éxito
        return redirect()->route('gastos.dashboard')->with('success', 'Gasto actualizado con éxito.');
    }

    
    public function destroy($id)
    {
        // Buscar el gasto por su ID
        $gasto = Gasto::findOrFail($id);

        // Eliminar el gasto
        $gasto->delete();

        // Redirigir al usuario de vuelta a la lista de gastos con un mensaje de éxito
        return redirect()->route('gastos.dashboard')->with('success', 'Gasto eliminado con éxito.');
    }

    public function generarGrafica()
    {
        return view('gastos.generargrafica');
    }

    public function getReportData(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        $gastos = Gasto::where('user_id', Auth::id())
                        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                        ->get();
    
        if ($gastos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron gastos para el rango de fechas especificado.'], 404);
        }
    
        $datos = $gastos->groupBy('categoria')->map(function ($grupo) {
            return $grupo->sum('valor');
        });
    
        return response()->json($datos);
    }
    
    
    public function showEscanearRecibo()
    {
        return view('gastos.escanearRecibo');
    }

 

    public function processReceipt(Request $request)
    {
        try {
            $request->validate([
                'receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
    
            $path = $request->file('receipt')->store('receipts', 'public');
            $imagePath = storage_path("app/public/{$path}");
    
            // Procesar la imagen con Tesseract para extraer texto
            $tesseract = new TesseractOCR($imagePath);
            $tesseract->executable('/usr/bin/tesseract'); 
            $extractedText = $tesseract->lang('spa')->run();
            
    
            // Extraer datos del ticket
            $data = $this->parseReceiptText($extractedText);
    
            // Crear el gasto en la base de datos
            Gasto::create([
                'nombre_gasto' => $data['nombre'],
                'valor' => $data['total'],
                'fecha' => $data['fecha'],
                'descripcion' => 'Ticket procesado automáticamente',
                'categoria' => 'Compra',
                'user_id' => Auth::id(),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Gasto creado con éxito a partir del ticket',
            ]);
        } catch (\Exception $e) {
            Log::error('Error en el procesamiento del ticket: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error en el procesamiento del ticket',
            ], 500);
        }
    }
    
    

    private function parseReceiptText($text)
    {
        // Implementa aquí la lógica de extracción de datos con expresiones regulares
        $nombre = 'Nombre de tienda';
        $total = 0.00;
        $fecha = date('Y-m-d');

        // Ejemplo simple de extracción
        if (preg_match('/Total:\s*([\d\.]+)/i', $text, $matches)) {
            $total = floatval($matches[1]);
        }

        return [
            'nombre' => $nombre,
            'total' => $total,
            'fecha' => $fecha,
        ];
    }
    
    public function mostrarGastosCompartidos()
    {
        $user = Auth::user();
    
        // Recupera y agrupa los gastos compartidos por el nombre del usuario con el que se compartió
        $gastosCompartidos = GastoCompartido::with(['gasto', 'gasto.user', 'sharedWithUser'])
            ->where('user_id', $user->id)
            ->orWhere('shared_with', $user->id)
            ->get()
            ->groupBy(function ($gastoCompartido) use ($user) {
                return $gastoCompartido->shared_with === $user->id
                    ? $gastoCompartido->gasto->user->name
                    : $gastoCompartido->sharedWithUser->name;
            });
    
        return view('gastos.compartidos', compact('gastosCompartidos'));
    }
    
    public function exportarGastos()
    {
        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Establecer encabezados
        $sheet->setCellValue('A1', 'Nombre Gasto');
        $sheet->setCellValue('B1', 'Tipo');
        $sheet->setCellValue('C1', 'Fecha');
        $sheet->setCellValue('D1', 'Descripción');
        $sheet->setCellValue('E1', 'Categoría');

        //Establecer el ancho de las celdas
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);

        // Obtener los gastos del usuario autenticado
        $expenses = Gasto::where('user_id', Auth::id())->get();

        // Agregar datos a cada fila
        $row = 2;
        foreach ($expenses as $expense) {
            $sheet->setCellValue('A' . $row, $expense->nombre_gasto); // Nombre del gasto
            $sheet->setCellValue('B' . $row, $expense->tipo); // Tipo del gasto
            $sheet->setCellValue('C' . $row, $expense->fecha); // Fecha del gasto
            $sheet->setCellValue('D' . $row, $expense->descripcion); // Descripción del gasto
            $sheet->setCellValue('E' . $row, $expense->categoria); // Categoría del gasto
            $row++;
        }

        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);

        // Definir el nombre del archivo y enviar la respuesta de descarga
        $fileName = 'gastos_usuario_' . Auth::id() . '.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}





