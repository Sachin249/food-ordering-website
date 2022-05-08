<?php
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('admin');


Route::get('/admin', function () {
    return view('admin/admin_login');
})->name('admin');

Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');
Route::group(['middleware'=>'admin_auth'],function()
{
    Route::get('admin/admin_controller',[AdminController::class,'index'])->name('index');
    Route::get('admin/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('admin/users',[AdminController::class,'users'])->name('users_view');
    Route::get('admin/user/user_status/{status_value}/{id}',[AdminController::class,'updateUserStatus']);
    Route::get('admin/dashboard/notification',[AdminController::class,'notification'])->name('noti');
    Route::get('admin/category',[CategoryController::class,'index'])->name('category_view');
    Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
    Route::post('admin/category/category_insert',[CategoryController::class,'create'])->name('category.insert');
    Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
    Route::get('admin/category/edit/{id}',[CategoryController::class,'edit']);
    Route::put('admin/category/edit/{id}',[CategoryController::class,'update'])->name('update');
    Route::get('admin/category/status/{status_value}/{id}',[CategoryController::class,'updateCategoryStatus']);

    Route::get('admin/product',[ProductController::class,'index'])->name('products_view');
    Route::get('admin/product/manage_product',[ProductController::class,'manage_product']);
    Route::post('admin/product/product_insert',[ProductController::class,'create'])->name('product.insert');
    Route::get('admin/product/delete/{id}',[ProductController::class,'delete']);
    Route::get('admin/product/edit/{id}',[ProductController::class,'edit']);
    Route::put('admin/product/edit/{id}',[ProductController::class,'update'])->name('update');
    Route::get('admin/product/status/{status_value}/{id}',[ProductController::class,'updateProductStatus']);

    Route::get('admin/coupon',[CouponController::class,'index'])->name('coupon_view');
    Route::get('admin/coupon/manage_coupon',[CouponController::class,'manage_coupon']);
    Route::post('admin/coupon/coupon_insert',[CouponController::class,'create'])->name('coupon.insert');
    Route::get('admin/coupon/delete/{id}',[CouponController::class,'delete']);
    Route::get('admin/coupon/edit/{id}',[CouponController::class,'edit']);
    Route::put('admin/coupon/edit/{id}',[CouponController::class,'update'])->name('update');
    Route::get('admin/coupon/status/{status_value}/{id}',[CouponController::class,'updateCouponStatus']);

    Route::get('admin/orders',[OrdersController::class,'index'])->name('orders_view');
    Route::get('admin/orders/order_status/{status_value}/{id}',[OrdersController::class,'updateOrderStatus']);
    Route::get('admin/orders/order_packed/{order_packed_value}/{id}',[OrdersController::class,'updatePackedStatus']);
    Route::get('admin/orders/on_the_way_status/{on_the_way_value}/{id}',[OrdersController::class,'updateOnwayStatus']);
    Route::get('admin/orders/order_delivered/{order_delivered_value}/{id}',[OrdersController::class,'updateDeliveredStatus']);
    
    Route::get('admin/service',[ServiceController::class,'index'])->name('service_view');
    Route::get('admin/service/manage_service',[ServiceController::class,'manage_service']);
    Route::post('admin/service/service_insert',[ServiceController::class,'create'])->name('service.insert');
    Route::get('admin/service/delete/{id}',[ServiceController::class,'delete']);
    Route::get('admin/service/service_status/{service_value}/{id}',[ServiceController::class,'updateServiceStatus']);
    Route::get('admin/service/edit/{id}',[ServiceController::class,'edit']);
    Route::put('admin/service/edit/{id}',[ServiceController::class,'update'])->name('service.update');
    
    Route::get('admin/staff',[StaffController::class,'index'])->name('staff_view');
    Route::get('admin/staff/manage_staff',[StaffController::class,'manage_staff']);
    Route::post('admin/staff/staff_insert',[StaffController::class,'create'])->name('staff.insert');
    Route::get('admin/staff/staff_status/{staff_value}/{id}',[StaffController::class,'updateStaffStatus']);
    Route::get('admin/staff/delete/{id}',[StaffController::class,'delete']);
    Route::get('admin/staff/edit/{id}',[StaffController::class,'edit']);
    Route::put('admin/staff/edit/{id}',[StaffController::class,'update'])->name('staff.update');

    Route::get('admin/contact',[ContactController::class,'index'])->name('contact_view');
    Route::get('admin/contact/edit/{id}',[ContactController::class,'edit']);
    Route::put('admin/contact/edit/{id}',[ContactController::class,'update'])->name('staff.update');
    // admin logout
    Route::get('admin/Logout',[AdminController::class,'getLogout'])->name('Logout');
});

//user routes
Route::get('/user_login', function () {
    if(Session::get('USER_LOGIN'))
    {
        return redirect('user/homepage');
    }else
    {
        return view('user/user_login'); 
    }
});
Route::post('user/auth',[UserController::class,'auth'])->name('user.auth');
Route::post('user/registration',[UserController::class,'user_registration']);
Route::group(['middleware'=>'user_auth'],function()
{
    Route::get('/user/homepage', function () {
        return view('user/homepage');
    });
    Route::get('/user/homepage',[UserController::class,'homepage'])->name('homepage');
    Route::get('user/homepage/product_details/{id}',[UserController::class,'product_details']);
    Route::post('user/homepage/purchase_order/{id}',[UserController::class,'purchase_order'])->name('purchase_order');
    Route::get('user/homepage/myorders/',[UserController::class,'myorders'])->name('myorders');
    Route::get('user/homepage/mycart/',[UserController::class,'mycart'])->name('mycart');
    Route::post('user/homepage/searchProduct/',[UserController::class,'searchProduct'])->name('searchProduct');
    Route::get('user/homepage/myorders/check_status/{orderid}/{productid}',[UserController::class,'order_status']);
    Route::get('user/homepage/account_setting/',[UserController::class,'edit_profile'])->name('account_setting');
    Route::put('user/homepage/account_setting/update_profile/{id}',[UserController::class,'update_profile']);
    Route::post('user/homepage/account_setting/change_password/{id}',[UserController::class,'change_password']);
    Route::post('/add_to_cart',[UserController::class,'addToCart'])->name('addToCart');
    Route::post('/update_cart',[UserController::class,'updateCart'])->name('updateCart');
    Route::get('user/homepage/deleteCartProduct/{id}',[UserController::class,'deleteCartProduct'])->name('deletecart');
    Route::get('user/checkout/',[UserController::class,'checkout'])->name('checkout');
    Route::post('/place_order',[UserController::class,'placeOrder'])->name('placeOrder');
    Route::get('/order_placed',[UserController::class,'order_placed'])->name('order_placed');
    Route::get('/order_receipt/{id}',[UserController::class,'order_receipt'])->name('order_receipt');
    Route::post('/apply_coupon_code',[UserController::class,'apply_coupon_code']);
    Route::post('/remove_coupon_code',[UserController::class,'remove_coupon_code']);
    Route::get('/payment_gateway_redirect',[UserController::class,'payment_gateway_redirect']);
    // user logout process
    Route::get('user/logout',[UserController::class,'getLogout'])->name('userlogout');
    
});
Route::get('verification/{id}',[UserController::class,'email_verification'])->name('email_verification');
