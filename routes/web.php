<?php 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GastoController;
use Illuminate\Support\Facades\Route;

// Ruta principal (homepage)
Route::get('/', function () {
    return view('gastos.index'); // Mostrar la vista de la homepage
});

// Rutas de autenticación
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Ruta para el dashboard (donde se mostrarán los gastos)una vez autenticado
Route::get('/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/gastos', [GastoController::class, 'store'])->name('gastos.store'); // Ruta para almacenar el gasto
Route::get('/gastos/create', [GastoController::class, 'create'])->middleware('auth')->name('gastos.create');
Route::get('/gastos/create', [GastoController::class, 'create'])->middleware('auth')->name('gastos.create');
Route::post('/gastos', [GastoController::class, 'store'])->middleware('auth')->name('gastos.store');
Route::get('/gastos/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('gastos.dashboard');


