<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

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


Route::get('clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('view:cache');
    dd("Successfully, you have cleared all cache of application.");
});

Route::get('/activa-storage', function () {
    Artisan::call('storage:link');
    dd("creado");
});