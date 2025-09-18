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
/** POSTS     **/Route::resource('/posts', PostController::class)->names('admin.posts');
/** CATEGORIES**/Route::resource('categories',CategoriesController::class)->names('admin.categories');


/** NOTIFICATIONS **/
// Route::get('/posts/notify', [PostController::class,'notification'])->name('admin.notifications.index');


Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});
