<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfNotLoggedIn;

//Home page
Route::get('/', function () {
    return view('frontend/index');
});

//Logout
Route::get('/logout', [AuthController::class, 'getLogout']);

//Login---register
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister']);

});
//Login google
Route::get('/user/auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::get('rooms', [HomeController::class, 'getrooms']);
    //Search
    Route::get('/search',[HomeController::class,'search'])->name('rooms.search');
    Route::get('introduction', [HomeController::class, 'getintroduction']);
    Route::get('terms-of-service', [HomeController::class, 'gettermsofservice']);
    Route::get('details', [HomeController::class, 'getdetails']);
    Route::get('contact', [HomeController::class, 'getcontact']);
    Route::get('services', [HomeController::class, 'getservices']);
    Route::get('/rooms/{id}', 'HomeController@show')->name('room.show');
    Route::get('/room_detail/{id}', [HomeController::class, 'showDetail'])->name('room.detail');
    
    //Member
    Route::middleware('auth')->group(function () {
        Route::get('account', [HomeController::class, 'getaccount'])->name('account');
        Route::post('updateinfo', [HomeController::class, 'updateProfile'])->name('updateinfo');
        Route::post('updateorder-{id}', [HomeController::class, 'updateOrder'])->name('updateorder');
        Route::get('payment-{id}', [HomeController::class, 'payment'])->name('payment');
        Route::get('order-{room_id}-{user_id}', [HomeController::class, 'order'])->name('order');
        Route::post('order-{room_id}-{user_id}', [HomeController::class, 'postOrder'])->name('postorder');        
    });

//Admin
Route::group(['middleware' => 'auth.redirect'], function () {
    // dashboard
    Route::get('/admin-dashboard', [DashboardController::class, 'getdashboard']);
    //services
    Route::get('/admin-services', [ServiceController::class, 'getservices']);
    Route::get('/admin-service-add', [ServiceController::class, 'getserviceadd']);
    Route::post('/admin-service-add', [ServiceController::class, 'postserviceadd'])->name('serviceadd');
    Route::get('/admin-service-delete-{id}',[ServiceController::class, 'deleteservice'])->name('deleteservice');
    Route::get('/admin-service-edit-{id}',[ServiceController::class, 'getserviceedit'])->name('getserviceedit');
    Route::post('/admin-service-edit-{id}',[ServiceController::class, 'postserviceedit'])->name('postserviceedit');
    //users
    Route::get('/admin-users', [UserController::class, 'getusers']);
    Route::get('/admin-user-add', [UserController::class, 'getuseradd']);
    Route::post('/admin-user-add', [UserController::class, 'postuseradd'])->name('useradd');
    Route::get('/admin-users-delete-{id}', [UserController::class, 'getuserdelete'])->name('getuserdelete');
    Route::post('/admin-user-edit-{id}', [UserController::class, 'postuseredit'])->name('postuseredit');
    Route::get('/admin-users-edit-{id}', [UserController::class, 'getuseredit'])->name('getuseredit');
    //room-types
    Route::get('/admin-room-types', [RoomTypeController::class, 'getroomtypes']);
    Route::get('/admin-room-type-add', [RoomTypeController::class, 'getroomtypeadd']);
    Route::post('/admin-room-type-add', [RoomTypeController::class, 'postroomtypeadd'])->name('roomtypeadd');
    Route::get('/admin-room-type-delete-{id}',[RoomTypeController::class, 'deleteroomtype'])->name('deleteroomtype');
    Route::get('/admin-room-type-edit-{id}',[RoomTypeController::class, 'getroomtypeedit'])->name('roomtypeedit');
    Route::post('/admin-room-type-edit-{id}',[RoomTypeController::class, 'postroomtypeedit'])->name('roomtypeedit');
    //rooms
    Route::get('/admin-rooms', [RoomController::class, 'getrooms']);
    Route::get('/admin-room-add', [RoomController::class, 'getroomadd']);
    Route::post('/admin-room-add', [RoomController::class, 'postroomadd'])->name('roomadd');
    Route::get('/admin-room-delete-{id}',[RoomController::class, 'deleteroom'])->name('deleteroom');
    Route::get('/admin-room-edit-{id}',[RoomController::class, 'getroomedit'])->name('roomedit');
    Route::post('/admin-room-edit-{id}',[RoomController::class, 'postroomedit'])->name('roomedit');
    //  Orders
    Route::get('/admin-orders', [OrderController::class, 'getorders'])->name('orders');
    Route::get('/admin-order-add', [OrderController::class, 'getorderadd']);
    Route::post('/admin-order-add', [OrderController::class, 'postorderadd'])->name('orderadd');
    Route::get('/admin-order-delete-{id}',[OrderController::class, 'deleteorder'])->name('orderdelete');
    Route::get('/admin-order-edit-{id}',[OrderController::class, 'getorderedit'])->name('orderedit');
    Route::post('/admin-order-edit-{id}',[OrderController::class, 'postorderedit'])->name('orderedit');  
    
    Route::get('/admin-order-approved-{id}', [OrderController::class,'orderapproved'])->name('orderapproved');
    Route::get('/admin-order-cancel-{id}', [OrderController::class,'ordercancel'])->name('ordercancel');
   //notification
    Route::get('/notification', [DashboardController::class,'notification'])->name('notification');
});
