<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;

Route::get('/',function(){
 return view('welcome');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest:admin'],function(){
         Route::view('login','admin.login')->name('admin.login');
         Route::post('login',[AdminController::class,'login'])->name('admin.auth');
    });
    Route::group(['middleware'=>'admin.auth'],function(){
         Route::view('/dashboard','admin.dashboard.index')->name('admin.home');
         Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');
         Route::get('/settings', [SettingController::class,'index'])->name('admin.settings');
         Route::post('/settings', [SettingController::class,'update'])->name('admin.settings.update');
         Route::group(['prefix'  =>'categories'], function() {
            Route::get('/', [CategoryController::class,'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class,'create'])->name('admin.categories.create');
            Route::post('/store', [CategoryController::class,'store'])->name('admin.categories.store');
            Route::get('/{id}/edit', [CategoryController::class,'edit'])->name('admin.categories.edit');
            Route::post('/update', [CategoryController::class,'update'])->name('admin.categories.update');
            Route::get('/{id}/delete', [CategoryController::class,'delete'])->name('admin.categories.delete');
        
        });
        Route::group(['prefix'  =>   'attributes'], function() {

            Route::get('/', [AttributeController::class,'index'])->name('admin.attributes.index');
            Route::get('/create', [AttributeController::class,'create'])->name('admin.attributes.create');
            Route::post('/store', [AttributeController::class,'store'])->name('admin.attributes.store');
            Route::get('/{id}/edit',[AttributeController::class,'edit'])->name('admin.attributes.edit');
            Route::post('/update', [AttributeController::class,'update'])->name('admin.attributes.update');
            Route::get('/{id}/delete', [AttributeController::class,'delete'])->name('admin.attributes.delete');
        });
 Route::post('/get-values', [AttributeValueController::class,'getValues']);
Route::post('/add-values', [AttributeValueController::class,'addValues']);
Route::post('/update-values', [AttributeValueController::class,'updateValues']);
Route::post('/delete-values', [AttributeValueController::class,'deleteValues']);

});


});


