<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NegocioController as AdminNegocioController;
use App\Http\Controllers\Admin\CategoriaNegocioController as AdminCategoriaController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/negocio/{id}', [NegocioController::class, 'show'])->name('negocios.show');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

// Admin auth
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin routes (protected)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('negocios', AdminNegocioController::class)->names('negocios');
    Route::delete('negocios/{negocio}/imagen/{imagen}', [AdminNegocioController::class,'destroyImage'])->name('negocios.imagen.destroy');
    Route::resource('categorias', AdminCategoriaController::class)->names('categorias');
    // NOTE: Slides will be generated from existing `negocio` records (no slides table)
    // Productos admin
    Route::resource('productos', App\Http\Controllers\Admin\ProductoController::class)->names('productos');
    Route::delete('productos/{producto}/imagen/{imagen}', [App\Http\Controllers\Admin\ProductoController::class,'destroyImage'])->name('productos.imagen.destroy');
});
