<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//paystation original route
Route::post('checkout',[CheckoutController::class,'checkout'])->name('checkout');
Route::get('store-transaction/{token}',[CheckoutController::class,'storeTransaction'])->name('store-transaction');
// Route::post('store-transaction',[CheckoutController::class,'storeTransaction'])->name('store-transaction');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('shop', [HomeController::class, 'shop'])->name('shop');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('news', [HomeController::class, 'news'])->name('news');
Route::get('cart', [HomeController::class, 'cart'])->name('cart');
Route::post('submit-contact-form', [HomeController::class, 'submitContactForm'])->name('contactForm');
Route::get('productjson', [ProductController::class, 'productJson']);
Route::post('place-order', [OrderController::class, 'placeOrder'])->name('place-order');


Route::resources([
    // 'category' => CategoryController::class,
    'product' => ProductController::class,
 ]);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resources([
        'category' => CategoryController::class,
        'order' => OrderController::class,
        // 'product' => ProductController::class,
     ]);
     
});

require __DIR__.'/auth.php';
