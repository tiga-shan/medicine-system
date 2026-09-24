<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ReportController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    Route::post('/cart/add/{medicine}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{medicineId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{medicineId}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('medicines', MedicineController::class);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');

    Route::get('prescriptions', [PrescriptionController::class, 'index'])->name('admin.prescriptions.index');
    Route::patch('prescriptions/{prescription}/status', [PrescriptionController::class, 'updateStatus'])->name('admin.prescriptions.update-status');

    Route::get('deliveries', [DeliveryController::class, 'index'])->name('admin.deliveries.index');
    Route::post('deliveries/{order}/assign', [DeliveryController::class, 'assign'])->name('admin.deliveries.assign');
    Route::patch('deliveries/{order}/status', [DeliveryController::class, 'updateStatus'])->name('admin.deliveries.update-status');

    Route::get('reports', [ReportController::class, 'index'])->name('admin.reports.index');
});

require __DIR__.'/auth.php';