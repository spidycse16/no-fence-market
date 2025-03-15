<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CatagoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCatagoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function(){
    //all the admin pages will have /admin/___________
        Route::prefix('admin')->group(function(){

            Route::controller(AdminMainController::class)->group(function(){
                Route::get('/dashboard','index')->name('adminDashboard');
                Route::get('/settings','setting')->name('admin.settings');
                Route::get('/manage/users/','manage_user')->name('admin.manage.user');
                Route::get('/manage/stores','manage_store')->name('admin.manage.store');
                Route::get('/cart/history','cart_history')->name('admin.cart.history');
                Route::get('/order/history','order_history')->name('admin.order.history');

            });

            Route::controller(CatagoryController::class)->group(function(){
                Route::get('/catagory/create','index')->name('catagory.create');
                Route::get('catagory/manage','manage')->name('catagory.manage');
            });

            Route::controller(SubCatagoryController::class)->group(function(){
                Route::get('/subcatagory/create','index')->name('subcatagory.create');
                Route::get('/subcatagory/manage','manage')->name('subcatagory.manage');
            });

            Route::controller(ProductController::class)->group(function(){
                Route::get('/product/manage','index')->name('product.manage');
                Route::get('/product/review/manage','review_manage')->name('product.review.manage');
            });

            Route::controller(ProductAttributeController::class)->group(function(){
                Route::get('/productattribute/create','index')->name('productattribute.create');
                Route::get('/productattribute/manage','manage')->name('productattribute.manage');
            });

            Route::controller(ProductDiscountController::class)->group(function(){
                Route::get('/discount/create','index')->name('discount.create');
                Route::get('/discount/manage','manage')->name('discount.manage');
            });
        });
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:customer'])->name('dashboard');


Route::get('/vendor/dashboard', function () {
    return view('vendor.dashboard');
})->middleware(['auth', 'verified','rolemanger:vendor'])->name('vendorDashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
