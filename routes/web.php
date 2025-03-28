<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\ApproveController;
use App\Http\Controllers\Admin\CatagoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCatagoryController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\MasterCatagoryController;
use App\Http\Controllers\MasterSubcatagoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\VendorMainController;
use App\Http\Controllers\Seller\VendorProductController;
use App\Http\Controllers\Seller\VendorStoreController;
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
                Route::POST('/default/attribute/create','createAttribute')->name('attribute.create');
                Route::GET('/attribute/{id}','showAttribute')->name('show.attribute');
                Route::PUT('/attribute/update/{id}','updateAttribute')->name('update.attribute');
                Route::delete('/attribute/delete/{id}','deleteAttribute')->name('delete.attribute');
            });

            Route::controller(ProductDiscountController::class)->group(function(){
                Route::get('/discount/create','index')->name('discount.create');
                Route::get('/discount/manage','manage')->name('discount.manage');
            });

            Route::controller(MasterCatagoryController::class)->group(function(){
                Route::POST('/store/catagory','storeCatagory')->name('store.catagory');
                Route::GET('/catagory/{id}','showCat')->name('show.catagory');
                Route::PUT('/catagory/update/{id}','updateCat')->name('update.catagory');
                Route::delete('/catagory/delete/{id}','deleteCat')->name('delete.catagory');

            });

            Route::controller(MasterSubcatagoryController::class)->group(function(){
                Route::POST('/store/subcatagory','storeSubcat')->name('store.subcatagory');
                Route::GET('/subcatagory/{id}','showSubcat')->name('show.subcatagory');
                Route::PUT('/subcatagory/update/{id}','updateSubcat')->name('update.subcatagory');
                Route::delete('/subcatagory/delete/{id}','deleteSubcat')->name('delete.subcatagory');
                
            });

            Route::controller(ApproveController::class)->group(function(){
                Route::get('/approve/show','show')->name('admin.vendor.index');
                Route::patch('/{id}/approve', 'approve')->name('admin.vendor.approve');
                Route::delete('/{id}/reject', 'reject')->name('admin.vendor.reject');
                
            });


        });
});

//vendor routes
Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function(){
    //all the admin pages will have /vendor/___________
        Route::prefix('vendor')->group(function(){

            Route::controller(VendorMainController::class)->group(function(){
                Route::get('/dashboard','index')->name('vendorDashboard');
                Route::get('/order/history','orderHistory')->name('vendor.order.history');
                
                
            });

            Route::controller(VendorProductController::class)->group(function(){
                Route::get('/product/create','index')->name('vendor.product.create');
                Route::get('/product/manage','manage')->name('vendor.product.manage');
                Route::POST('/product/store','storeProduct')->name('vendor.product.store');
            });

            Route::controller(VendorStoreController::class)->group(function(){
                Route::get('/store/create','index')->name('vendor.store.create');
                Route::get('/store/manage','manage')->name('vendor.store.manage');
                Route::POST('/store/publish','publish')->name('store.publish');
                Route::get('/show/store/{id}/','edit')->name('store.edit');
                Route::delete('/delete/store/{id}', 'delete')->name('store.destroy');
                Route::put('/update/store/{id}','update')->name('store.update');

            });
            

        });
});

Route::middleware(['auth', 'verified', 'rolemanager:customer'])->group(function(){
    //all the  pages will have /user/___________
        Route::prefix('user')->group(function(){

            Route::controller(CustomerMainController::class)->group(function(){
                Route::get('/dashboard','index')->name('customerDashboard');
                Route::get('/order/history','orderHistory')->name('customer.order.history');
                Route::get('/setting/payment','payment')->name('customer.payment');
                Route::get('/affiliate','affiliate')->name('customer.affiliate');
                Route::get('/products','products')->name('customer.products');
                Route::get('/products/{id}','show')->name('customer.product.show');
                Route::get('/search', 'search')->name('customer.search');
                Route::get('/search/autocomplete', 'autocomplete')->name('customer.search.autocomplete');
                Route::get('/profile','profile')->name('user.profile');
                Route::get('/register','vendorRegister')->name('vendor.register');
                Route::POST('/approve','vendorApprove')->name('vendor.approve');
            });

            Route::controller(CartController::class)->group(function(){
                Route::POST('/cart/add','add')->name('cart.add');
                Route::get('/cart', 'index')->name('customer.cart');
                Route::post('/cart/update', 'update')->name('cart.update');
                Route::post('/cart/remove', 'remove')->name('cart.remove');
            });
   

        });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//invalidate a session
Route::get('/flush', function () {
    Session::flush();
    return redirect('/login');
    })->name('flush');

require __DIR__.'/auth.php';
