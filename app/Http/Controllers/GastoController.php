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

    // Otros métodos show, edit, update, destroy según necesidad
}



