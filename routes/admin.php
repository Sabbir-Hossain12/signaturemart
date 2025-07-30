<?php


use App\Http\Controllers\Admin\AdminAuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    
    //Auth
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');

    Route::post('/login', [AdminAuthController::class, 'store']);
    
   
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    
    //Dashboard
    Route::view('/dashboard', 'admin.pages.dashboard')->name('dashboard');
});