<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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
Auth::routes();


Route::get('/',[menuController::class, 'index'])->name('menu');
Route::group(['middleware'=>'auth'], function(){
    Route::get('/user/user-information',[UserController::class,'profile'])->name('user.profile');
    Route::post('/user/update-information',[UserController::class,'updateProfile'])->name('update.profile');
    Route::get('/user/addresses',[UserController::class,'addresses'])->name('user.addresses');
    Route::post('/user/add-address',[UserController::class,'addAddress'])->name('add.address');
    Route::post('/user/update-address',[UserController::class,'updateAddress'])->name('update.address');
    Route::delete('/user/delete-address',[UserController::class,'deleteAddress'])->name('delete.address');
    Route::get('/user/my-orders',[OrderController::class,'showOrders'])->name('user.orders');
    Route::post('/add-to-cart',[CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart',[CartController::class, 'show']);
    Route::post('/cart/update-quantity/{item}',[CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::delete('/cart/delete/{item}',[CartController::class, 'delete'])->name('cart.delete');
    Route::get('/cart/checkout',[checkoutController::class,'showCheckout'])->name('checkout');
    Route::post('/cart/place-order',[checkoutController::class,'placeOrder'])->name('placeOrder');
    Route::get('/success',[checkoutController::class,'success'])->name('success');
});


Route::group(['middleware'=>['auth', 'role:admin']], function(){
    Route::get('/admin/dashboard',[DashboardController::class, 'get'])->name('admin.dashboard');
    Route::get('/admin/notifications',[NotificationsController::class, 'index'])->name('admin.notifications');
    Route::get('/admin/notification/order-details/{order}/{notificationId}',[NotificationsController::class, 'orderDetailsNotification'])->name('admin.orderDetailsNotification');
    Route::get('/admin/orders-list',[AdminOrderController::class, 'orders'])->name('admin.oredersList');
    Route::get('/admin/order-details/{order}',[AdminOrderController::class, 'orderDetails'])->name('admin.orederDetails');
    Route::post('/admin/update-order-status/{order}',[AdminOrderController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/menu/edit-meal/{item}',[MealController::class, 'edit'])->name('admin.editMeal');
    Route::post('/admin/menu/update-meal/{item}',[MealController::class, 'update'])->name('admin.updateMeal');
    Route::delete('/admin/menu/delete-meal/{item}',[MealController::class, 'delete'])->name('admin.deleteMeal');
    Route::get('/admin/add-meal-page',[MealController::class, 'addPage'])->name('admin.addMealPage');
    Route::post('/admin/add-meal-page/add-meal',[MealController::class, 'add'])->name('admin.addMeal');
    Route::get('/admin/sections',[SectionsController::class, 'get'])->name('admin.sections');
    Route::post('/admin/sections/add-section',[SectionsController::class, 'add'])->name('admin.addSection');
    Route::post('/admin/sections/update-section',[SectionsController::class, 'update'])->name('admin.updateSection');
    Route::delete('/admin/sections/delete-section',[SectionsController::class, 'delete'])->name('admin.deleteSection');
    Route::get('/admin/customers',[CustomersController::class, 'get'])->name('admin.customers');
    Route::get('/admin/customer-details/{customer}',[CustomersController::class, 'customerDetails'])->name('admin.customerDetails');
    Route::post('/admin/add-customer',[CustomersController::class, 'add'])->name('admin.addCustomer');
});

