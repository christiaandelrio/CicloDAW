<?php 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\InvitacionController;
use App\Http\Controllers\PerfilUsuarioController; 
use App\Http\Controllers\PerfilConfiguracionController; 
use Illuminate\Support\Facades\Route;

/**
 * Fichero que contiene las rutas de la aplicación
 */

// Ruta principal (homepage)
Route::get('/', function () {
    if (Auth::check()) {
        // Si el usuario está autenticado, redirigir al dashboard
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostrar el índice (home)
    return view('gastos.index');
})->name('index');

// ===================================
// Rutas de Autenticación
// ===================================
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ===================================
// Rutas del Dashboard (Autenticación Requerida)
// ===================================
Route::get('/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('dashboard');

// ===================================
// Rutas de Gastos
// ===================================
// CRUD de Gastos
Route::get('/gastos/create', [GastoController::class, 'create'])->middleware('auth')->name('gastos.create');
Route::post('/gastos', [GastoController::class, 'store'])->middleware('auth')->name('gastos.store');
Route::get('/gastos/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('gastos.dashboard');
Route::put('gastos/{gasto}', [GastoController::class, 'update'])->name('gastos.update');
Route::get('gastos/{gasto}/edit', [GastoController::class, 'edit'])->name('gastos.edit');
Route::get('gastos/compartidos/{gastoCompartido}/edit', [GastoController::class, 'edit'])->name('gastos.compartidos.edit');
Route::delete('gastos/{gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy');

// Funcionalidades adicionales de Gastos
Route::get('/gastos/generargrafica', [GastoController::class, 'generarGrafica'])->middleware('auth')->name('gastos.generargrafica');
Route::post('/gastos/generargrafica/data', [GastoController::class, 'getReportData'])->middleware('auth')->name('gastos.generargrafica.data');
Route::get('/gastos/escanear-recibo', [GastoController::class, 'showEscanearRecibo'])->name('gastos.escanearRecibo');
Route::post('/gastos/process-receipt', [GastoController::class, 'processReceipt'])->middleware('auth')->name('gastos.processReceipt');

// Gastos Compartidos
Route::middleware('auth')->group(function () {
    Route::get('/gastos/compartidos', [GastoController::class, 'mostrarGastosCompartidos'])->name('gastos.compartidos');
});
Route::get('/gastoscompartidos', [InvitacionController::class, 'mostrarGastosCompartidos'])->middleware('auth')->name('gastoscompartidos');

// Exportación de Gastos
Route::get('/export-expenses', [GastoController::class, 'exportarGastos'])->name('gasto.exportarGastos');

// ===================================
// Rutas del Perfil
// ===================================
Route::get('/perfil', [PerfilUsuarioController::class, 'show'])->middleware('auth')->name('perfil');

// Configuración del Perfil
Route::get('/perfil/configuracion', [PerfilConfiguracionController::class, 'index'])->name('perfil.configuracion');
Route::post('/perfil/configuracion/update', [PerfilConfiguracionController::class, 'update'])->name('perfil.configuracion.update');

/**
 * Rutas necesarias para enviar invitaciones en la función de gastos compartidos, ambas protegidas por autenticación
 */
Route::middleware(['auth'])->group(function () {
    Route::post('/invitaciones/enviar', [InvitacionController::class, 'enviar'])->name('invitaciones.enviar');
    Route::post('/invitaciones/{id}/responder', [InvitacionController::class, 'responder'])->name('invitaciones.responder');
});

/** Ruta que marca que el nuevo usuario ha visto el tutorial de primeros pasos */
Route::post('/tutorial-visto', [GastoController::class, 'marcarTutorialVisto'])->middleware('auth')->name('tutorial.visto');

Route::get('/dashboard/chart-data', [GastoController::class, 'getDashboardChartData'])->middleware('auth')->name('dashboard.chartData');
