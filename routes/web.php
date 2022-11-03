<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlideController;
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
        return view('welcome');
});
// laravel khoa phạm
// Route::get('index',[PageController::class, 'getIndex'])
// ->name('trangchu');
// Route::get('loai-san-pham/{type}',[PageController::class, 'getLoaiSp'])
// ->name('loaisanpham');
// Route::get('chi-tiet-san-pham/{id}',[PageController::class, 'getChiTietSp'])
// ->name('chitietsanpham');
// Route::get('lien-he',[PageController::class, 'getLienHe'])
// ->name('lienhe');
// Route::get('gioi-thieu',[PageController::class, 'getGioiThieu'])
// ->name('gioithieu');
// Route::get('add-to-cart/{id}',[PageController::class, 'getAddToCart'])
// ->name('themgiohang');
// Route::get('del-to-cart/{id}',[PageController::class, 'getDelCart'])
// ->name('xoagiohang');


//
Route::get('home',[PageController::class, 'index'])
->name('trangchu');

Route::get('producttype/{type}',[PageController::class, 'producttype'])
->name('loaisanpham');

Route::get('productdetail/{id}',[PageController::class, 'productdetail'])
->name('chitietsanpham');

Route::get('contact',[PageController::class, 'Contact'])
->name('lienhe');

Route::get('about',[PageController::class, 'About'])
->name('gioithieu');

Route::get('add-to-cart/{id}',[PageController::class, 'getAddToCart'])
->name('themgiohang');

Route::get('del-to-cart/{id}',[PageController::class, 'getDelCart'])
->name('xoagiohang');

Route::get('dat-hang',[PageController::class, 'getCheckout'])
->name('dathang');
Route::post('dat-hang',[PageController::class, 'postCheckout'])
->name('dathang2');

Route::get('search',[PageController::class, 'Search'])
->name('timkiem');
// Route::resource('products',ProductController::class);


// Route::get('checkout',function(){
//         return view('banhang.checkout');
// })->name('checkout');

Route::get('/signup',[PageController::class,'getSignup'])->name('getSignup');
Route::post('/signup',[PageController::class,'postSignup'])->name('postSignup');

Route::get('/login',[PageController::class,'getLogin'])->name('getLogin');
Route::post('/login',[PageController::class,'postLogin'])->name('postLogin');

Route::get('/logout',[PageController::class,'getLogout'])->name('logout');

Route::get('/administrator',function(){
        return view('admin.layout.master');
        });

Route::get('/register',[UserController::class,'getSignupadmin'])->name('getSignupadmin');
Route::post('/register',[UserController::class,'postSignupadmin'])->name('postSignupadmin');

Route::get('/loginadmin',[UserController::class,'getLoginadmin'])->name('getLoginadmin');
Route::post('/loginadmin',[UserController::class,'postLoginadmin'])->name('postLoginadmin');

Route::resource('users',UserController::class);

Route::get('/users/{id}/edit',[UserController::class, 'edit']);
Route::get('/user-detail/{id}',[UserController::class, 'show']);

Route::resource('type_products',ProductTypeController::class);

Route::resource('products',ProductController::class);

Route::get('/products/{id}/edit',[UserController::class, 'edit']);

Route::resource('slides',SlideController::class);
Route::get('/users/{{id}}/edit',function(){
        return view('admin.user-edit');
        });
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
    Route::get('users',function(){
        return view('admin.user-list');
    } );

            Route::group(['prefix'=>'category'],function(){
                // admin/category/danhsach
                Route::get('users',[UserController::class,'index'])->name('admin.user-list');
                // admin/category/them
                // Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
                // Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
                // Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
                // Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
                // Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
            });

            //viết tiếp các route khác cho crud products, users,.... thì viết tiếp

            // Route::group(['prefix'=>'bill'],function(){
            //     // admin/bill/{status}
            //     Route::get('{status}',[BillController::class,'getBillList'])->name('admin.getBillList');

            //     //by laravel request
            //     Route::get('{id}/{status}',[BillController::class,'updateBillStatus'])->name('admin.updateBillStatus');
            //     //by ajax request
            //     Route::post('updateBillStatusAjax',[BillController::class,'updateBillStatusAjax'])->name('admin.updateBillStatusAjax');

            //     Route::post('{id}',[BillController::class,'cancelBill'])->name('admin.cancelBill');
            // });

    });

    Route::resource('bills',BillController::class);
