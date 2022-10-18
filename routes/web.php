<?php

use App\Http\Controllers\MailController;
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
Route::get('/homepage', [App\Http\Controllers\HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('{id}', [App\Http\Controllers\CategoryController::class, 'newsofcategory'])->name('categories.newsofcategory');
    });
    Route::group(['prefix' => 'news'], function () {
        Route::get('', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
        Route::get('create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
        Route::post('store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
        Route::get('edit/{id}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::post('update/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
        Route::get('delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        Route::get('create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::post('store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::get('edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::post('update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        Route::get('delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
        Route::get('create', [App\Http\Controllers\OrdersController::class, 'create'])->name('orders.create');
        Route::post('store', [App\Http\Controllers\OrdersController::class, 'store'])->name('orders.store');
        Route::get('show/{id}', [App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
        Route::post('update/{id}', [App\Http\Controllers\OrdersController::class, 'update'])->name('orders.update');
        Route::get('delete/{id}', [App\Http\Controllers\OrdersController::class, 'destroy'])->name('orders.destroy');
    });
});

Route::get('add-cart/{id}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::get('delete-item/{id}', [App\Http\Controllers\CartController::class, 'destroyItem'])->name('cart.destroy');
Route::get('delete-list/{id}', [App\Http\Controllers\CartController::class, 'destroyList'])->name('cart.destroylist');
Route::get('list-carts', [App\Http\Controllers\CartController::class, 'index'])->name('cart.list');
Route::post('update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');


Route::get('sigin-in', [App\Http\Controllers\SiginInController::class, 'index'])->name('sigin-in.index');
Route::post('sigin-in', [App\Http\Controllers\SiginInController::class, 'store'])->name('sigin-in.store');
Route::get('sigin-out', [App\Http\Controllers\SiginOutController::class, 'siginOut'])->name('sigin-out');
Route::get('sigin-up', [App\Http\Controllers\SiginUpController::class, 'index'])->name('sigin-up.index');
Route::post('sigin-up', [App\Http\Controllers\SiginUpController::class, 'store'])->name('sigin-up.store');

Route::post('place-order', [App\Http\Controllers\PlaceOrderController::class, 'store'])->name('place-order.store');

Route::get('send-mail',[MailController::class,'index']);