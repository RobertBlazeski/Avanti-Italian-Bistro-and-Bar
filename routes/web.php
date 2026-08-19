<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Owner\OrderController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('Basic_UI.index');})->name('home');
Route::get('Basic_UI/about-us', [PageController::class, 'about'])->name('about-us');


//foods
Route::get('Basic_UI/main-dishes', [DishController::class, 'mainDishes'])->name('main-dishes');
Route::get('Basic_UI/salads', [DishController::class, 'salads'])->name('salads');
Route::get('Basic_UI/desserts', [DishController::class, 'desserts'])->name('desserts');
Route::get('Basic_UI/drinks', [DishController::class, 'drinks'])->name('drinks');
Route::get('Basic_UI/specialties', [DishController::class, 'specialties'])->name('specialties');



//user
Route::middleware(['auth'])->group(function () {
    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{dish}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

//checkout

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

//reservations

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});




//breeze dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//breeze profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




//owner
Route::middleware(['auth', 'owner'])->group(function () {

    //orders
    Route::get('/owner/orders', [OrderController::class, 'index'])->name('owner.orders');
    Route::post('/owner/orders/reset', [OrderController::class, 'resetOrdersCount'])->name('owner.resetOrdersCount');
    Route::post('/owner/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/owner/new-orders-count', [OrderController::class, 'getNewOrdersCount'])->name('owner.new-orders-count');

//reservations
    Route::get('/owner/reservations', [ReservationController::class, 'ownerIndex'])->name('owner.reservations');
    Route::patch('/owner/reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('owner.reservations.approve');
    Route::patch('/owner/reservations/{reservation}/decline', [ReservationController::class, 'decline'])->name('owner.reservations.decline');
   
//add dish
    Route::get('/owner/add-dish', [DishController::class, 'createDishView'])->name('owner.addDish');
    Route::post('/dishes/store', [DishController::class, 'storeDish'])->name('dishes.store');

//edit and delete dish
    Route::get('/dishes/{id}/edit', [DishController::class, 'editDish'])->name('dishes.edit')->middleware('auth');
    Route::put('/dishes/{id}', [DishController::class, 'updateDish'])->name('dishes.update')->middleware('auth');
    Route::delete('/dishes/{id}', [DishController::class, 'deleteDish'])->name('dishes.delete')->middleware('auth');
});



require __DIR__.'/auth.php';
