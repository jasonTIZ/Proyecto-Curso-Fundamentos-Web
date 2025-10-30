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
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NegocioController as AdminNegocioController;
use App\Http\Controllers\Admin\CategoriaNegocioController as AdminCategoriaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/negocio/{id}', [NegocioController::class, 'show'])->name('negocios.show');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

// Admin routes (no auth applied here; secure as needed)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('negocios', AdminNegocioController::class)->names('negocios');
    Route::resource('categorias', AdminCategoriaController::class)->names('categorias');
});
