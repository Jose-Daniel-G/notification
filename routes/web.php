<?php

use App\Http\Controllers\News\CategoriesController;
 use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Auth::routes(['register'=>false]); // Route::get('/', function () {return view('welcome');}); // Route::get('/', function () {return view('auth.login');});

/** LANDPAGE  **/Route::get('/landpage', function () {return Auth::check() ? app(HomeController::class)->index() : view('template.index'); });
/** LOGIN     **/Route::get('/', function () {return Auth::check() ? app(HomeController::class)->index() : view('auth.login'); });
/** REGISTER  **/Route::get('/register', function () {return redirect('/');});
/** DASHBOARD **/Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');});// ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});

   
 // Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
/** NOTIFICATIONS **/

// /** POSTS     **/Route::resource('/posts', PostController::class)->names('admin.posts');
/** POSTS     **/Route::resource('/posts', PostController::class)->names('admin.posts')->parameters(['posts' => 'post']);
/** CATEGORIES**/Route::resource('categories',CategoriesController::class)->names('admin.categories');

Route::middleware(['auth'])->group(function () {
    Route::resource('/notifications', NotificationController::class)->names('admin.notifications');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/{id}/readone', [NotificationController::class, 'read'])->name('admin.notifications.read');

});
