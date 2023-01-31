<?php

use Illuminate\Support\Facades\Route;

/*===MIDDLEWARE===*/
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\CustomerAuthenticate;

/*===CONTROLLERS===*/
use App\Http\Controllers\WebController\AuthController;
use App\Http\Controllers\WebController\VendorController;
use App\Http\Controllers\WebController\CustomerController;
use App\Http\Controllers\WebController\AdminController;
use App\Http\Controllers\WebController\CategoriesController;
use App\Http\Controllers\WebController\ProductController;
use App\Http\Controllers\WebController\CartController;
use App\Http\Controllers\WebController\StoreController;
use App\Http\Controllers\WebController\CheckoutController;
use App\Http\Controllers\WebController\ProductReviewController;
use App\Http\Controllers\WebController\CustomerReviewController;

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


Route::get('/', [StoreController::class, 'index']);
Route::get('/fetch_products', [StoreController::class, 'fetch_products']);

/*
* Authentication
*/
/* === vendor login === */
Route::get('/vendor/login', [AuthController::class, 'vendor_login']);
/* === vendor save login === */
Route::post('/vendor/login', [AuthController::class, 'save_vendor_login'])->name('login');
/* === vendor register === */
Route::get('/vendor/register', [AuthController::class, 'vendor_register']);
/* === vendor save register === */
Route::post('/vendor/register', [AuthController::class, 'save_vendor_register'])->name('register');
/* === vendor verify email === */
Route::get('/vendor/verify_email', [AuthController::class, 'verify_email'])->name('verify_email');

/* === admin login === */
Route::get('/admin/login', [AuthController::class, 'admin_login']);
/* === admin save login === */
Route::post('/admin/login', [AuthController::class, 'save_admin_login'])->name('login');


/* === customer login === */
Route::get('/login', [AuthController::class, 'customer_login']);
/* === customer save login === */
Route::post('/login', [AuthController::class, 'save_customer_login'])->name('login');
/* === customer register === */
Route::get('/register', [AuthController::class, 'customer_register']);
/* === customer save register === */
Route::post('/register', [AuthController::class, 'save_customer_register'])->name('register');
/* === customer verify email === */
Route::get('/verify_email', [AuthController::class, 'customer_verify_email'])->name('verify_email');

Route::get('/verify_message', [StoreController::class, 'verify_message'])->name('verify_message');

Route::middleware([AdminAuthenticate::class])->group( function () {
    // LOGOUTS
    Route::get('/vendor/logout', [AuthController::class, 'vendor_logout']);
    Route::get('/admin/logout', [AuthController::class, 'admin_logout']);
    Route::get('/logout', [AuthController::class, 'customer_logout']);

    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::get('/table_categories', [CategoriesController::class, 'table']);
    Route::get('/create_category', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('/store_category', [CategoriesController::class, 'store'])->name('category.store');
    Route::get('/edit_category/{id}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::post('/update_category', [CategoriesController::class, 'update'])->name('category.update');
    Route::get('/destroy_category/{id}', [CategoriesController::class, 'destroy'])->name('category.destroy');

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/table_products', [ProductController::class, 'table']);
    Route::get('/create_product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store_product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit_product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update_product', [ProductController::class, 'update'])->name('product.update');
    Route::get('/destroy_product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/table_vendors', [VendorController::class, 'table']);
    Route::get('/create_vendor', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/store_vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/edit_vendor/{id}', [VendorController::class, 'edit'])->name('vendor.edit');
    Route::post('/update_vendor', [VendorController::class, 'update'])->name('vendor.update');
    Route::get('/destroy_vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::get('/search_vendor', [VendorController::class, 'search']);

    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/table_customers', [CustomerController::class, 'table']);
    Route::get('/create_customer', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/store_customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/edit_customer/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/update_customer', [CustomerController::class, 'update'])->name('customer.update');
    Route::get('/destroy_customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/search_customer', [CustomerController::class, 'search']);

    Route::get('/carts', [CartController::class, 'index']);
    Route::get('/table_carts', [CartController::class, 'table']);
    Route::get('/create_cart', [CartController::class, 'create'])->name('cart.create');
    Route::post('/store_cart', [CartController::class, 'store'])->middleware('customerCheck')->name('cart.store');
    Route::get('/edit_cart/{id}', [CartController::class, 'edit'])->name('cart.edit');
    Route::post('/update_cart', [CartController::class, 'update'])->name('cart.update');
    Route::get('/destroy_cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/admins', [AdminController::class, 'index']);
    Route::get('/table_admins', [AdminController::class, 'table']);
    Route::get('/create_admin', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store_admin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit_admin/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/update_admin', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/destroy_admin', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/checkouts', [CheckoutController::class, 'index']);
    Route::get('/table_checkouts', [CheckoutController::class, 'table']);
    Route::get('/checkout_customer_review/{id}', [CheckoutController::class, 'add_checkout_customer_review']);
    Route::post('/store_customer_review', [CustomerReviewController::class, 'store_checkout_customer_review']);
    Route::get('/checkout/{id}', [CheckoutController::class, 'show']);
    // Route::get('/destroy_checkouts/{id}', [CheckoutController::class, 'destroy'])->name('cart.destroy');

    Route::get('/vendor/profile', [VendorController::class, 'profile'])->name('vendor.profile');
});

Route::get('/store/categories/{id}', [StoreController::class, 'categories']);
Route::get('/store/product/{id}', [StoreController::class, 'product']);
Route::get('/store/search', [StoreController::class, 'search']);
Route::get('/store/vendor/{id}', [StoreController::class, 'vendor']);
Route::get('/store/reviews/{id}', [StoreController::class, 'reviews']);
Route::get('/store/product_order', [StoreController::class, 'product_orders']);


Route::middleware([CustomerAuthenticate::class])->group( function () {
    Route::post('/change_password', [AuthController::class, 'change_password'])->name('change_password');
    Route::get('/store/profile', [StoreController::class, 'profile']);
    Route::post('/store/update_profile', [StoreController::class, 'update_profile']);
    Route::get('/store/profile_order_table', [StoreController::class, 'profile_order_table']);
    Route::get('/store/carts', [CartController::class, 'customer_carts']);
    Route::get('/store/update_quantity', [CartController::class, 'update_quantity']);
    Route::get('/store/checkout/{id}', [StoreController::class, 'checkout']);
    Route::get('/store/checkout_detail/{id}', [StoreController::class, 'checkout_detail']);
    Route::get('/store/checkout_extend/{checkout}', [StoreController::class, 'checkout_extend']);
    Route::get('/store/update_checkout_status', [StoreController::class, 'update_checkout_status']);
    Route::get('/store/disabled_dates', [StoreController::class, 'get_disabled_dates']);
    Route::post('/store/store_checkout', [CheckoutController::class, 'store_checkout']);

    Route::get('/store/return_checkout', [StoreController::class, 'return_checkout']);
    Route::post('/store/return_checkout', [StoreController::class, 'post_checkout']);

    Route::get('/store/write_review/{id}', [ProductReviewController::class, 'write_review']);
    Route::post('/store/store_review', [ProductReviewController::class, 'store_review']);
});
