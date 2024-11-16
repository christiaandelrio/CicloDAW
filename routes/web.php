<?php 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\InvitacionController;
use App\Http\Controllers\PerfilUsuarioController; 
use App\Http\Controllers\PerfilConfiguracionController; 
use Illuminate\Support\Facades\Route;

// Ruta principal (homepage)
Route::get('/', function () {
    if (Auth::check()) {
        // Si el usuario está autenticado, redirigir al dashboard
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostrar el índice (home)
    return view('gastos.index');
})->name('index');

// Rutas de autenticación
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Ruta para el dashboard (donde se mostrarán los gastos)una vez autenticado
Route::get('/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('dashboard');

// Rutas de gastos
Route::get('/gastos/create', [GastoController::class, 'create'])->middleware('auth')->name('gastos.create');
Route::post('/gastos', [GastoController::class, 'store'])->middleware('auth')->name('gastos.store');
Route::get('/gastos/dashboard', [GastoController::class, 'index'])->middleware('auth')->name('gastos.dashboard');
Route::put('gastos/{gasto}', [GastoController::class, 'update'])->name('gastos.update');
Route::get('gastos/{gasto}/edit', [GastoController::class, 'edit'])->name('gastos.edit');
Route::delete('gastos/{gasto}', [GastoController::class, 'destroy'])->name('gastos.destroy');

// Ruta para el perfil de usuario
Route::get('/perfil', [PerfilUsuarioController::class, 'show'])->name('perfil');


Route::get('/gastos/generargrafica', [GastoController::class, 'generarGrafica'])->middleware('auth')->name('gastos.generargrafica');
Route::post('/gastos/generargrafica/data', [GastoController::class, 'getReportData'])->middleware('auth')->name('gastos.generargrafica.data');

Route::get('/gastos/escanear-recibo', [GastoController::class, 'showEscanearRecibo'])->name('gastos.escanearRecibo');
Route::post('/gastos/process-receipt', [GastoController::class, 'processReceipt'])->name('gastos.processReceipt');
Route::post('/gastos/process-receipt', [GastoController::class, 'processReceipt'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/gastos/compartidos', [GastoController::class, 'mostrarGastosCompartidos'])->name('gastos.compartidos');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/invitaciones/{id}/responder', [InvitacionController::class, 'responder'])->name('invitaciones.responder');
    Route::get('/perfil', [PerfilUsuarioController::class, 'show'])->name('perfil');
    Route::post('/invitaciones/enviar', [InvitacionController::class, 'enviar'])->name('invitaciones.enviar');
    Route::get('/gastoscompartidos', [InvitacionController::class, 'mostrarGastosCompartidos'])->name('gastoscompartidos');
    Route::get('/gastos/compartidos', [GastoController::class, 'mostrarGastosCompartidos'])->name('gastos.compartidos');

});

Route::get('/export-expenses', [GastoController::class, 'exportarGastos'])->name('gasto.exportarGastos');


// Ruta para mostrar la configuración
Route::get('/perfil/configuracion', [PerfilConfiguracionController::class, 'index'])->name('perfil.configuracion');

// Ruta para actualizar la configuración
Route::post('/perfil/configuracion/update', [PerfilConfiguracionController::class, 'update'])->name('perfil.configuracion.update');

Route::post('/tutorial-visto', [GastoController::class, 'marcarTutorialVisto'])->middleware('auth')->name('tutorial.visto');
