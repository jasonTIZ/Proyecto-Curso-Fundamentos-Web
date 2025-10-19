<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BusinessController as AdminBusinessController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\BusinessController as WebBusinessController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\ContactController;

/*
|--------------------------------------------------------------------------
| Rutas de Autenticación
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas del Sitio Web Público
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/buscar', [HomeController::class, 'search'])->name('search');
Route::get('/categorias', [WebCategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{id}', [WebCategoryController::class, 'show'])->name('categories.show');
Route::get('/comercios/{id}', [WebBusinessController::class, 'show'])->name('businesses.show');
Route::get('/productos/{id}', [WebProductController::class, 'show'])->name('products.show');
Route::post('/comercios/{id}/contacto', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Rutas del Panel Administrativo (Protegidas)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/', function () {
        return redirect()->route('admin.businesses.index');
    });

    // Gestión de Slides
    Route::resource('slides', SlideController::class)->names([
        'index' => 'admin.slides.index',
        'create' => 'admin.slides.create',
        'store' => 'admin.slides.store',
        'show' => 'admin.slides.show',
        'edit' => 'admin.slides.edit',
        'update' => 'admin.slides.update',
        'destroy' => 'admin.slides.destroy',
    ]);

    // Gestión de Categorías
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // Gestión de Comercios
    Route::resource('businesses', AdminBusinessController::class)->names([
        'index' => 'admin.businesses.index',
        'create' => 'admin.businesses.create',
        'store' => 'admin.businesses.store',
        'show' => 'admin.businesses.show',
        'edit' => 'admin.businesses.edit',
        'update' => 'admin.businesses.update',
        'destroy' => 'admin.businesses.destroy',
    ]);

    // Gestión de Galería de Comercios
    Route::prefix('businesses/{business}')->group(function () {
        Route::get('/gallery', [AdminBusinessController::class, 'gallery'])->name('admin.businesses.gallery');
        Route::post('/gallery', [AdminBusinessController::class, 'storeGalleryImage'])->name('admin.businesses.gallery.store');
        Route::delete('/gallery/{image}', [AdminBusinessController::class, 'destroyGalleryImage'])->name('admin.businesses.gallery.destroy');
    });

    // Gestión de Productos
    Route::prefix('businesses/{business}')->group(function () {
        Route::resource('products', AdminProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);
    });

    // Gestión de Galería de Productos
    Route::prefix('products/{product}')->group(function () {
        Route::get('/gallery', [AdminProductController::class, 'gallery'])->name('admin.products.gallery');
        Route::post('/gallery', [AdminProductController::class, 'storeGalleryImage'])->name('admin.products.gallery.store');
        Route::delete('/gallery/{image}', [AdminProductController::class, 'destroyGalleryImage'])->name('admin.products.gallery.destroy');
    });
});
