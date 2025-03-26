<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\CategoryController;
use App\http\Controllers\ProductController;
use App\http\Controllers\FrontEndController;
use App\http\Controllers\ContactController;
use App\http\Controllers\AjaxController;

// 
Route::get('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [FrontEndController::class, 'processCheckout'])->name('checkout.process');
Route::get('/thankyou', function () {
    return view('frontend.thankyou');
})->name('thankyou');
// 
Route::get('/',[FrontEndController::class, 'mainview'])->name('mainview');
Route::get('/welcome',[FrontEndController::class, 'index'])->name('welcome.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/show', [ContactController::class, 'store'])->name('contact.show');
Route::get('/orders', [FrontEndController::class, 'viewOrders'])->name('orders.view');
Route::get('/orders/{id}', [FrontEndController::class, 'orderDetails'])->name('orders.details');
//

Route::post('/cart/{product_id}', [FrontEndController::class, 'addToCart'])->name('addtocart');
Route::get('/cart', [FrontEndController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/remove/{product_id}', [FrontEndController::class, 'removeCart'])->name('remove.from.cart');

//////////////////////// Role of Admin ///////////////////////////////////
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/category/select/{id}', [AjaxController::class, 'categorySelect'])->name('category.select');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('/dashboard', function () {
        return view('admin-dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
/////////////////////// Role of User ///////////////////////////////////////
Route::middleware(['auth' , 'role:user'])->group(function () {
    Route::get('/test',function(){
        return view('test');
    });
});
//

require __DIR__.'/auth.php';
