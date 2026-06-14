<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CronogramaController;
use App\Http\Controllers\Admin\PrecioController;
use App\Http\Controllers\Admin\ParticipanteController;
use App\Http\Controllers\Admin\RecursoController;
use App\Http\Controllers\Admin\UserAdminController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', fn() => view('home'))->name('home');
Route::get('/ingresar', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->hasRole('admin')
        ? redirect()->route('admin.dashboard')
        : redirect()->route('portal.dashboard');
})->name('ingresar');
Route::get('/inscripcion', [RegistroController::class, 'show'])->name('inscripcion');
Route::post('/inscripcion', [RegistroController::class, 'store'])->name('inscripcion.store');

// Autenticación
Route::get('/login', [LoginController::class, 'show'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Portal del participante (requiere autenticación)
Route::middleware('auth')->prefix('portal')->name('portal.')->group(function () {
    // API JSON para el SPA Vue
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/me',               [PortalController::class, 'apiMe'])->name('me');
        Route::get('/cronograma',       [PortalController::class, 'apiCronograma'])->name('cronograma');
        Route::get('/recursos',         [PortalController::class, 'apiRecursos'])->name('recursos');
        Route::put('/mis-datos',        [PortalController::class, 'apiUpdateMisDatos'])->name('mis-datos');
        Route::put('/cambiar-password', [PortalController::class, 'apiUpdatePassword'])->name('cambiar-password');
    });

    // SPA Vue — todas las rutas del portal sirven la misma vista
    Route::get('/{any?}', [PortalController::class, 'spa'])->where('any', '.*')->name('dashboard');
});

// Panel de administración (requiere autenticación + rol admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('stats');

    Route::resource('/cronograma', CronogramaController::class)->except(['show']);
    Route::resource('/precios', PrecioController::class)->except(['show']);

    // Participantes / Registros
    Route::get('/participantes',                    [ParticipanteController::class, 'index'])->name('participantes.index');
    Route::get('/participantes/{registro}',          [ParticipanteController::class, 'show'])->name('participantes.show');
    Route::get('/participantes/{registro}/edit',     [ParticipanteController::class, 'edit'])->name('participantes.edit');
    Route::put('/participantes/{registro}',          [ParticipanteController::class, 'update'])->name('participantes.update');
    Route::delete('/participantes/{registro}',       [ParticipanteController::class, 'destroy'])->name('participantes.destroy');
    Route::patch('/participantes/{registro}/toggle', [ParticipanteController::class, 'toggleConfirmado'])->name('participantes.toggle');

    // Usuarios del sistema
    Route::resource('/usuarios', UserAdminController::class)->except(['show']);

    // Recursos
    Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');
    Route::post('/recursos', [RecursoController::class, 'store'])->name('recursos.store');
    Route::delete('/recursos/{r}', [RecursoController::class, 'destroy'])->name('recursos.destroy');
});
