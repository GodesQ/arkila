<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\CustomerController;
use App\Http\Controllers\ApiController\VendorController;
use App\Http\Controllers\ApiController\StoreController;
use App\Http\Controllers\ApiController\CartController;
use App\Http\Controllers\ApiController\ProductController;
use App\Http\Controllers\ApiController\CheckoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// PUBLIC ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/vendor_login', [AuthController::class, 'vendor_login']);
Route::post('/vendor_register', [AuthController::class, 'vendor_register']);
Route::get('/store/products/', [StoreController::class, 'products']);
Route::get('/store/reviews/', [StoreController::class, 'reviews']);
Route::get('/store/product/', [StoreController::class, 'show_product']);
Route::get('/store/categories/', [StoreController::class, 'categories']);
Route::get('/review', [StoreController::class, 'review']);
Route::get('/store/disabled_dates', [StoreController::class, 'get_disabled_dates']);
Route::get('/store/vendor', [VendorController::class, 'shop_profile']);

Route::middleware('customerApiAuth')->group(function () {
    Route::get('/profile', [CustomerController::class, 'profile']);
    Route::post('/profile', [CustomerController::class, 'update_profile']);
    Route::get('/store/carts', [CartController::class, 'customer_carts']);
    Route::get('/store/delete_cart', [CartController::class, 'destroy']);
    Route::post('/store/store_cart', [CartController::class, 'store']);
    Route::get('/store/checkout', [StoreController::class, 'checkout']);
    Route::post('/vendor_checkout_notification', [StoreController::class, 'vendor_checkout_notification']);
    Route::get('/checkout/detail', [CheckoutController::class, 'customer_checkout']);
    Route::post('/store_checkout', [CheckoutController::class, 'store']);
    Route::post('/update_checkout_status', [CheckoutController::class, 'update_status']);
    Route::get('/customer_checkouts', [CheckoutController::class, 'customer_checkouts']);
    Route::post('/store_review', [StoreController::class, 'store_review']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('vendorApiAuth')->group(function () {
    /* Route for vendor logout */
    Route::post('/vendor_logout', [AuthController::class, 'vendor_logout']);
    
    Route::get('/vendor_dashboard', [VendorController::class, 'dashboard']);
    Route::get('/vendor_profile', [VendorController::class, 'vendor_profile']);
    Route::post('/update_vendor_profile', [VendorController::class, 'update_vendor']);
    
    /* Routes for vendor side products */
    Route::get('/vendor_products', [ProductController::class, 'vendor_products']);
    Route::get('/edit_product', [ProductController::class, 'edit']);
    Route::post('/update_product', [ProductController::class, 'update']);
    Route::get('/create_product', [ProductController::class, 'create']);
    Route::post('/store_product', [ProductController::class, 'store']);
    
    /* Routes for checkouts */
    Route::get('/vendor_checkouts', [CheckoutController::class, 'vendor_checkouts']);
    Route::get('/vendor_checkout', [CheckoutController::class, 'vendor_checkout']);
    Route::post('/store_vendor_review', [CheckoutController::class, 'store_vendor_review']);
    Route::post('/vendor_logout', [AuthController::class, 'vendor_logout']);
});