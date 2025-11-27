<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\NotificationController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\OrderController as AllOrderController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\user\AuthController as UserAuthController;
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



Route::get('/', [AuthController::class, 'loginView'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.store');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

    //admin
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

    //Product
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'show'])->name('admin.product.edit');
    Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');

    //Stock
    Route::get('/admin/stock', [StockController::class, 'index'])->name('admin.stock');
    Route::get('/admin/stock/create', [StockController::class, 'create'])->name('admin.stock.create');
    Route::post('/admin/stock/store', [StockController::class, 'store'])->name('admin.stock.store');
    Route::get('/admin/stock/edit/{id}', [StockController::class, 'show'])->name('admin.stock.edit');
    Route::post('/admin/stock/update/{id}', [StockController::class, 'update'])->name('admin.stock.update');

    Route::get('/admin/user/users', [AuthController::class, 'userIndex'])->name('admin.user.user');
    Route::get('/admin/users/download', [AuthController::class, 'downloadCSV'])->name('admin.users.download');

    //Order Section
    Route::get('/admin/order-list', [AllOrderController::class, 'order'])->name('admin.order-list');
    Route::patch('orders/{order}/permission', [AllOrderController::class, 'updatePermission']);
    Route::patch('orders/{order}/order-status', [AllOrderController::class, 'updateStatus']);

    Route::patch('/orders/{id}/payment-status', [OrderController::class, 'updatePaymentStatus']);

    Route::patch('/orders/{id}/resume-qty', [OrderController::class, 'resumeQtyStatus']);
});

Route::get('/user/register', [UserAuthController::class, 'register'])->name('register');
Route::post('/user/register/store', [UserAuthController::class, 'userregister'])->name('register.store');
Route::get('/user/login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/login_post', [UserAuthController::class, 'loginStore'])->name('user.login.post');


Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/user/dashboard', [UserAuthController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');

    //Product View
    Route::get('/user/product-list', [OrderController::class, 'productView'])->name('user.product');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/user/order/list', [OrderController::class, 'orderList'])->name('user.order.list');

    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAll']);
});
