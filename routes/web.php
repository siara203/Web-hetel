<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfNotLoggedIn;

Route::get('/', function () {
    return view('frontend/index');
});
Route::get('logout', [AuthController::class, 'getLogout']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister']);

});

Route::get('/user/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware('auth')->group(function () {
    Route::get('rooms', [HomeController::class, 'getrooms']);
    Route::get('introduction', [HomeController::class, 'getintroduction']);
    Route::get('terms-of-service', [HomeController::class, 'gettermsofservice']);
    Route::get('details', [HomeController::class, 'getdetails']);
    Route::get('contact', [HomeController::class, 'getcontact']);
    Route::get('services', [HomeController::class, 'getservices']);
    Route::get('account', [HomeController::class, 'getaccount'])->name('account');
    Route::post('updateinfo', [HomeController::class, 'updateProfile'])->name('updateinfo');
    Route::post('updateorder-{id}', [HomeController::class, 'updateOrder'])->name('updateorder');
    Route::get('payment-{id}', [HomeController::class, 'payment'])->name('payment');
});


Route::group(['middleware' => 'auth.redirect'], function () {
    // dashboard
    Route::get('/admin-dashboard', [AdminController::class, 'getdashboard']);
    //services
    Route::get('/admin-services', [AdminController::class, 'getservices']);
    Route::get('/admin-service-add', [AdminController::class, 'getserviceadd']);
    Route::post('/admin-service-add', [AdminController::class, 'postserviceadd'])->name('serviceadd');
    Route::get('/admin-service-delete-{id}',[AdminController::class, 'deleteservice'])->name('deleteservice');
    Route::get('/admin-service-edit-{id}',[AdminController::class, 'getserviceedit'])->name('getserviceedit');
    Route::post('/admin-service-edit-{id}',[AdminController::class, 'postserviceedit'])->name('postserviceedit');
    //users
    Route::get('/admin-users', [AdminController::class, 'getusers']);
    Route::get('/admin-user-add', [AdminController::class, 'getuseradd']);
    Route::post('/admin-user-add', [AdminController::class, 'postuseradd'])->name('useradd');
    Route::get('/admin-users-delete-{id}', [AdminController::class, 'getuserdelete'])->name('getuserdelete');
    Route::post('/admin-user-edit-{id}', [AdminController::class, 'postuseredit'])->name('postuseredit');
    Route::get('/admin-users-edit-{id}', [AdminController::class, 'getuseredit'])->name('getuseredit');
    //room-types
    Route::get('/admin-room-types', [AdminController::class, 'getroomtypes']);
    Route::get('/admin-room-type-add', [AdminController::class, 'getroomtypeadd']);
    Route::post('/admin-room-type-add', [AdminController::class, 'postroomtypeadd'])->name('roomtypeadd');
    Route::get('/admin-room-type-delete-{id}',[AdminController::class, 'deleteroomtype'])->name('deleteroomtype');
    Route::get('/admin-room-type-edit-{id}',[AdminController::class, 'getroomtypeedit'])->name('roomtypeedit');
    Route::post('/admin-room-type-edit-{id}',[AdminController::class, 'postroomtypeedit'])->name('roomtypeedit');
    //rooms
    Route::get('/admin-rooms', [AdminController::class, 'getrooms']);
    Route::get('/admin-room-add', [AdminController::class, 'getroomadd']);
    Route::post('/admin-room-add', [AdminController::class, 'postroomadd'])->name('roomadd');
    Route::get('/admin-room-delete-{id}',[AdminController::class, 'deleteroom'])->name('deleteroom');
    Route::get('/admin-room-edit-{id}',[AdminController::class, 'getroomedit'])->name('roomedit');
    Route::post('/admin-room-edit-{id}',[AdminController::class, 'postroomedit'])->name('roomedit');
    //  Orders
    Route::get('/admin-orders', [AdminController::class, 'getorders'])->name('orders');
    Route::get('/admin-order-add', [AdminController::class, 'getorderadd']);
    Route::post('/admin-order-add', [AdminController::class, 'postorderadd'])->name('orderadd');
    Route::get('/admin-order-delete-{id}',[AdminController::class, 'deleteorder'])->name('orderdelete');
    Route::get('/admin-order-edit-{id}',[AdminController::class, 'getorderedit'])->name('orderedit');
    Route::post('/admin-order-edit-{id}',[AdminController::class, 'postorderedit'])->name('orderedit');  
    
    Route::get('/admin-order-activate-{id}', [AdminController::class,'orderactivate'])->name('orderactivate');
    Route::get('/admin-order-cancel-{id}', [AdminController::class,'ordercancel'])->name('ordercancel');

});
