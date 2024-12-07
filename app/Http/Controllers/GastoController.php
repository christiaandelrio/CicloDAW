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


/**
 * Controlador principal de la aplicación encargado de gestionar los gastos de los usuarios
 */
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
            'medico'=>'fa-solid fa-hospital'
        ];

        $user = Auth::user();

        // Obtener los gastos del usuario autenticado
        $gastos = Gasto::where('user_id', $user->id)->get();


        $darkMode = $user->dark_mode;
        $mostrarTutorial = !$user->tutorial_visto; // Determinar si el tutorial debe mostrarse

        // Pasar tanto los gastos como las categorías y el estado del tutorial a la vista
        return view('gastos.dashboard', compact('gastos', 'categorias', 'darkMode', 'mostrarTutorial'));
    }


    /**
     * Método create empleado para crear nuevos gastos
     *
     * @return void
     */
    public function create()
    {
        $user = Auth::user();

        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
            'medico'=>'fa-solid fa-hospital'
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

    /**
     * Método store empleado para almacenar los gastos creados
     *
     * @param Request $request
     * @return void
     */
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

    /**
     * Método edit empleado para modificar un gasto
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        // Intentar encontrar el gasto como gasto compartido
        $gastoCompartido = GastoCompartido::find($id);

        if ($gastoCompartido) {
            // Si se encuentra el gasto como gasto compartido
            $gasto = $gastoCompartido->gasto; // Obtenemos el gasto relacionado
            $esGastoCompartido = true;
        } else {
            // Si no se encuentra como gasto compartido, buscamos como gasto normal
            $gasto = Gasto::findOrFail($id);
            $esGastoCompartido = false;
        }

        // Definir las categorías y sus iconos
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
        ];

        // Retornar la vista de edición con los datos del gasto o gasto compartido
        return view('gastos.edit', compact('gasto', 'categorias', 'esGastoCompartido'));
    }

    /**
     * Método update empleado para actualizar un gasto modificado
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
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

    /**
     * Método empleado a la hora de eliminar un gasto determinado
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        // Buscar el gasto por su ID
        $gasto = Gasto::findOrFail($id);

        // Eliminar el gasto
        $gasto->delete();

        // Redirigir al usuario de vuelta a la lista de gastos con un mensaje de éxito
        return redirect()->route('gastos.dashboard')->with('success', 'Gasto eliminado con éxito.');
    }

    /**
     * Funciones para las gráficas de generargrafica.blade.php
     *
     * @return void
     */
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

    /**
     * Para trabajar con las gráficas del dashboard
     *
     * @return void
     */
    public function getDashboardChartData()
    {
        $gastos = Gasto::where('user_id', Auth::id())->get();

        // Agrupar los gastos por categoría
        $gastosPorCategoria = $gastos->groupBy('categoria')->map(function ($grupo) {
            return $grupo->sum('valor');
        });

        // Agrupar los gastos por fecha para la gráfica de líneas
        $gastosPorFecha = $gastos->sortBy('fecha')->groupBy(function ($gasto) {
            // Verifica si la fecha es un objeto DateTime o una cadena
            return \Carbon\Carbon::parse($gasto->fecha)->format('Y-m-d');
        })->map(function ($grupo) {
            return $grupo->sum('valor');
        });

        return response()->json([
            'categorias' => $gastosPorCategoria->keys(), // Ejemplo: ["comida", "transporte"]
            'valores' => $gastosPorCategoria->values(), // Ejemplo: [200, 100]
            'fechas' => $gastosPorFecha->keys(), // Ejemplo: ["2024-11-01", "2024-11-02"]
            'valoresPorFecha' => $gastosPorFecha->values(), // Ejemplo: [200, 150]
        ]);
    }

    /**
     * Métodos encargados del escaneo e inserción de gastos a través de un ticket
     *
     * @return void
     */
    public function showEscanearRecibo()
    {
        return view('gastos.escanearRecibo');
    }

    /**
     * Se encarga de procesar la imagen obtenida comprobando formato, haciendo manejo de errores y asignando datos por defecto
     *
     * @param Request $request
     * @return void
     */
    public function processReceipt(Request $request)
    {
        try {
            // Validar que se suba una imagen
            $request->validate([
                'receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Guardar la imagen en el almacenamiento
            $path = $request->file('receipt')->store('receipts', 'public');
            $imagePath = storage_path("app/public/{$path}");

            // Procesar la imagen con Tesseract para extraer texto
            $tesseract = new TesseractOCR($imagePath);
            $tesseract->executable('/usr/bin/tesseract'); 
            $extractedText = $tesseract->lang('spa')->run(); //Incluye el diccionario de idioma español

            // Extraer datos del texto del ticket
            $data = $this->parseReceiptText($extractedText);

            // Validar que se encontró un total válido
            if (!$data['total'] || $data['total'] <= 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'No se detectó el total en el ticket. Intenta con otra imagen.',
                ], 400);
            }

            // Crear el gasto
            Gasto::create([
                'user_id' => Auth::id(),
                'nombre_gasto' => $data['nombre'] ?: 'Gasto desconocido',
                'tipo' => $data['tipo'] ?: 'General',
                'valor' => $data['total'],
                'fecha' => $data['fecha'] ?: now()->toDateString(),
                'descripcion' => 'Procesado automáticamente',
                'categoria' => 'Compra',
                'es_compartido' => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Gasto creado con éxito a partir del ticket.',
            ]);
        } catch (\Exception $e) {
            Log::error('Error procesando el ticket: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error en el procesamiento del ticket.',
            ], 500);
        }
    }

    /**
     * Se encarga de parsear los datos del ticket, incluye un diccionario con palabras frecuentes
     *
     * @param [type] $text
     * @return void
     */
    private function parseReceiptText($text)
    {
        // Diccionario para deducir el nombre
        $diccionario = [
            'supermercado' => 'Supermercado',
            'corte inglés' => 'El Corte Inglés',
            'farmacia' => 'Farmacia',
            'restaurante' => 'Restaurante',
            'tienda' => 'Tienda',
            'compra' => 'Compra',
            'Mercadona' => 'Mercadona',
            'A pagar' => 'Total',
            'Eroski' => 'Eroski'
        ];

        // Valores predeterminados
        $nombre = 'Gasto desconocido';
        $tipo = 'General';
        $total = 0.00;
        $fecha = now()->toDateString();

        // Buscar el total en el texto
        if (preg_match('/total.*?([\d.,]+)/i', $text, $matches)) {
            $total = floatval(str_replace(',', '.', $matches[1]));
        }

        // Buscar fecha
        if (preg_match('/(\d{2}[\/\-]\d{2}[\/\-]\d{4})/', $text, $matches)) {
            $fecha = \Carbon\Carbon::parse(str_replace('/', '-', $matches[1]))->format('Y-m-d');
        }

        // Buscar el nombre en el diccionario
        foreach ($diccionario as $clave => $valor) {
            if (stripos($text, $clave) !== false) {
                $nombre = $valor;
                break;
            }
        }

        return [
            'nombre' => $nombre,
            'tipo' => $tipo,
            'total' => $total,
            'fecha' => $fecha,
        ];
    }

    /**
     * Se encarga de mostrar los gastos compartidos de un usuario, recuperados previamente
     *
     * @return void
     */
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

    /**
     * Se encarga de generar la hoja de cálculo y asignar los datos de los gastos 
     *
     * @return void
     */
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

/**
 * Maneja la lógica que se encarga de comprobar y actualizar si un usuario ha visto el tutorial inicial o no
 *
 * @return void
 */
    public function marcarTutorialVisto()
    {
        try {
            $user = Auth::user(); // Obtiene el usuario autenticado

            if (!$user) {
                return response()->json(['success' => false, 'error' => 'Usuario no autenticado'], 403);
            }

            // Actualiza el campo tutorial_visto en la base de datos
            $user->tutorial_visto = true;
            $user->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error al marcar el tutorial como visto: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Error interno del servidor'], 500);
        }
    }
}
