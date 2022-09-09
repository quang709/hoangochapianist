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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/homepage', [App\Http\Controllers\HomepageController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
        Route::get('create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
        Route::post('store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
        Route::get('edit/{id}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::post('update/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
        Route::get('delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
    });
    
});



