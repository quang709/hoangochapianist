<?php


use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Fontend\DebitOrCreditCardController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\Fontend\PlaceOrderController;
use App\Http\Controllers\Fontend\SiginInController;
use App\Http\Controllers\Fontend\ForgetSessionController;
use App\Http\Controllers\Fontend\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fontend\GoogleSocialiteController;
use App\Http\Controllers\Fontend\HomepageController;
use App\Http\Controllers\Backend\PDFController;
use App\Http\Controllers\Fontend\SiginOutController;

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
Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('{id}', [CategoryController::class, 'newsofcategory'])->name('categories.newsofcategory');
    });
    Route::group(['prefix' => 'news'], function () {
        Route::get('', [NewsController::class, 'index'])->name('news.index');
        Route::get('create', [NewsController::class, 'create'])->name('news.create');
        Route::post('store', [NewsController::class, 'store'])->name('news.store');
        Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('update/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::get('delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('', [ProductController::class, 'index'])->name('products.index');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('create', [OrdersController::class, 'create'])->name('orders.create');
        Route::post('store', [OrdersController::class, 'store'])->name('orders.store');
        Route::get('show/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::post('update/{id}', [OrdersController::class, 'update'])->name('orders.update');
        Route::get('delete/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('', [CouponController::class, 'index'])->name('coupon.index');
        Route::get('create', [CouponController::class, 'create'])->name('coupon.create');
        Route::post('store', [CouponController::class, 'store'])->name('coupon.store');
        Route::get('edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
        Route::post('update/{id}', [CouponController::class, 'update'])->name('coupon.update');
        Route::get('delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
    });
});

Route::get('add-cart/{id}', [CartController::class, 'store'])->name('cart.store');
Route::get('delete-item/{id}', [CartController::class, 'destroyItem'])->name('cart.destroy');
Route::get('delete-list/{id}', [CartController::class, 'destroyList'])->name('cart.destroylist');
Route::get('list-carts', [CartController::class, 'index'])->name('cart.list');
Route::post('update', [CartController::class, 'update'])->name('cart.update');


Route::get('sigin-in', [SiginInController::class, 'index'])->name('sigin-in.index');
Route::post('sigin-in', [SiginInController::class, 'store'])->name('sigin-in.store');
Route::get('sigin-out', [SiginOutController::class, 'siginOut'])->name('sigin-out');
Route::get('sigin-up', [SiginUpController::class, 'index'])->name('sigin-up.index');
Route::post('sigin-up', [SiginUpController::class, 'store'])->name('sigin-up.store');

Route::post('place-order', [PlaceOrderController::class, 'store'])->name('place-order.store');

Route::get('send-mail',[MailController::class,'index']);

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle'])->name('google.store');
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::get('session-products',[ForgetSessionController::class,'index'])->name('session');


Route::post('add-money-stripe',[DebitOrCreditCardController::class,'postPaymentStripe'])->name('addmoney.stripe');

Route::get('create-pdf-file/{id}', [PDFController::class, 'index'])->name('pdf.index');

Route::post('applycoupon', [CartController::class, 'applyCoupon'])->name('coupon.check');