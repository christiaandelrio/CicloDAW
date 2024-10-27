<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
{
    public function index()
    {
        // Definir las categorías y sus iconos
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
            // Agrega más categorías según sea necesario
        ];
    
        // Obtener los gastos del usuario autenticado
        $gastos = Gasto::where('user_id', Auth::id())->get();
    
        // Pasar tanto los gastos como las categorías a la vista
        return view('gastos.dashboard', compact('gastos', 'categorias'));
    }
    

    public function create()
    {
        // Definir las categorías y sus iconos
        $categorias = [
            'comida' => 'fas fa-utensils',
            'mascota' => 'fas fa-paw',
            'transporte' => 'fas fa-bus',
            'ropa' => 'fa-solid fa-shirt',
            'decoracion' => 'fas fa-couch',
            // Agrega más categorías según sea necesario
        ];

        return view('gastos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_gasto' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string|max:255', // Validación de categoría
        ]);
        

        // Crear el gasto y asignarlo al usuario autenticado
        Gasto::create([
            'nombre_gasto' => $validatedData['nombre_gasto'],
            'tipo' => $validatedData['tipo'],
            'valor' => $validatedData['valor'],
            'fecha' => $validatedData['fecha'],
            'descripcion' => $validatedData['descripcion'],
            'categoria' => $validatedData['categoria'], // Debes asegurarte de que 'categoria' se está enviando aquí
            'user_id' => Auth::id(),
        ]);
        

        return redirect()->route('gastos.dashboard')->with('success', 'Gasto creado con éxito.');
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
    
    


}



