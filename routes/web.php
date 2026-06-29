<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MedicineController as AdminMedicineController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Medicine;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserOrderController;


Route::get('/', function () {

    $categories = Category::all();
    $medicines = Medicine::all();

    return view('welcome', compact('categories', 'medicines'));

});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');

// Auth-protected user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/myorders', [App\Http\Controllers\UserOrderController::class, 'index'])->name('myorders.index');
    Route::get('/myorders/{id}', [App\Http\Controllers\UserOrderController::class, 'track'])->name('myorders.track');
});

// Public routes — anyone can browse medicines
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::get('/medicines/{medicine:slug}', [MedicineController::class, 'show'])->name('medicines.show');
Route::get('/products', [MedicineController::class, 'index'])->name('products.index');




Route::middleware('admin')->name('admin.')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::resource('categories', AdminCategoryController::class)->except(['create', 'store']);
    Route::resource('medicines', AdminMedicineController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    

Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

});



Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', function ($order) {
    return view('checkout.success', ['orderId' => $order]);
})->name('checkout.success');

require __DIR__ . '/auth.php';


// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.categories')->middleware('admin');