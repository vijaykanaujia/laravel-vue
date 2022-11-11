<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('guest');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $props = ['title' => 'Dashboard'];
        return Inertia::render('Dashboard', $props);
    })->name('dashboard');
    Route::resource('menu', MenuController::class);
    Route::resource('role', RoleController::class);
    Route::any('role/{role}/permission', [RoleController::class, 'permission'])->name('role.permission');
    Route::resource('permission', PermissionController::class);
    Route::resource('user', UserController::class);

    Route::get('language/{language}', function ($language) {
        session()->put('locale', $language);
        return back();
    })->name('language');

    // notification routes
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');
    Route::delete('notification/{id}', [NotificationController::class, 'delete'])->name('delete.notification');
    Route::put('notification/{id}', [NotificationController::class, 'markAsRead'])->name('mark_as_read');
});
