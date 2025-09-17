<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PicoyplacaController;

// Route::get("/", [HomeController::class, "index"])->name("admin.home")->middleware('can:admin.home');

//RUTAS ADMIN
Route::get('/admin', [HomeController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/show_reservas/{id}', [HomeController::class, 'show_reservas'])->name('admin.show_reservas')->middleware('auth', 'can:admin.show_reservas');

//RUTAS CONFIGURACIONES
// Route::resource('/config', ConfigController::class)->names('admin.config')->middleware('auth', 'can:admin.config');
/** CONFIG PROFILE  **/
Route::get('/user/profile', [UserProfileController::class, 'index'])->name('admin.profile.index');
Route::put('/user/profile-information', [UserProfileController::class, 'update'])->name('admin.user-profile-information.update');
Route::put('/user/profile-password', [UserProfileController::class, 'updatePassword'])->name('admin.user-profile-password.updatePassword');


Route::middleware('auth')->group(function () {
    //PERMISIONS ROUTE
    Route::get('/permissions',        [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::post('/permissions',        [PermissionController::class, 'store'])->name('admin.permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
    Route::put('/permissions/{id}',  [PermissionController::class, 'update'])->name('admin.permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
    //ROLES ROUTES
    Route::resource('roles', RoleController::class)->names('admin.roles');
    //USERS ROUTES
    Route::resource('/users', UserController::class)->names('admin.users');
    Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
});

















// //RUTAS REPORTES PROFESORES ADMIN
// /*NO INCLUDO */
// Route::get('/profesores/pdf/{id}', [ProfesorController::class, 'reportes'])->name('admin.profesores.pdf');
// /*NO INCLUDO */
// Route::get('/profesores/reportes', [ProfesorController::class, 'reportes'])->name('admin.profesores.reportes')->middleware('auth', 'can:admin.profesores.reportes');

// //RUTAS para las reservas
// /*NO INCLUDO */
// Route::get('/reservas/reportes', [EventController::class, 'reportes'])->name('admin.reservas.reportes')->middleware('auth', 'can:admin.reservas.reportes');
// /*NO INCLUDO */
// Route::get('/reservas/pdf/{id}', [EventController::class, 'pdf'])->name('admin.reservas.pdf')->middleware('auth', 'can:admin.reservas.pdf');
// /*NO INCLUDO */
// Route::get('/reservas/pdf_fechas', [EventController::class, 'pdf_fechas'])->name('admin.reservas.pdf_fechas')->middleware('auth', 'can:admin.event.pdf_fechas');
