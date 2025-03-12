<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//admin routes
Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function(){
    Route::controller(AdminMainController::class)->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('dashboard','index')->name('adminDashboard');
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
