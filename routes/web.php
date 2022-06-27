<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
/* INICIO */
Route::get('/', [HomeController::class, 'index'])->name('inicio');
/* BLOG */
Route::get('/blog/{slug}', [BlogController::class, 'blog'])->name('blog');
Route::get('blog/category/{id}', [BlogController::class, 'category'])->name('category');
Route::get('blog/author/{id}', [BlogController::class, 'author'])->name('author');
Route::post('blog/busqueda', [BlogController::class, 'search'])->name('search');

// API 
Route::get('/api-posts/', [APIController::class, 'posts'])->name('api-posts');
Route::put('/api-insertar/', [APIController::class, 'insertar'])->name('api-insertar');
Route::post('/api-actualizar/', [APIController::class, 'actualizar'])->name('api-actualizar');


Route::get('clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('view:cache');
    dd("Ha borrado con éxito toda la caché de la aplicación.");
});

Route::get('/activa-storage', function () {
    Artisan::call('storage:link');
    dd("creado");
});