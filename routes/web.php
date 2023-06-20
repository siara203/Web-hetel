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

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister']);
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::get('logout', [AuthController::class, 'getLogout']);

Route::get('rooms', [HomeController::class, 'getrooms']);

Route::get('introduction', [HomeController::class, 'getintroduction']);

Route::get('terms-of-service', [HomeController::class, 'gettermsofservice']);
Route::get('details', [HomeController::class, 'getdetails']);

Route::get('contact', [HomeController::class, 'getcontact']);
Route::get('services', [HomeController::class, 'getservices']);
Route::group(['middleware' => 'auth.redirect'], function () {

    Route::get('/admin-dashboard', [AdminController::class, 'getdashboard']);
    
    Route::get('/admin-services', [AdminController::class, 'getservices']);
    Route::get('/admin-service-add', [AdminController::class, 'getserviceadd']);
    Route::post('/admin-service-add', [AdminController::class, 'postserviceadd'])->name('serviceadd');
    Route::get('/admin-service-delete-{id}',[AdminController::class, 'deleteservice'])->name('deleteservice');
    Route::get('/admin-service-edit-{id}',[AdminController::class, 'getserviceedit'])->name('getserviceedit');
    Route::post('/admin-service-edit-{id}',[AdminController::class, 'postserviceedit'])->name('postserviceedit');


    Route::get('/admin-orders', [AdminController::class, 'getorders']);
    Route::get('/admin-order-add', [AdminController::class, 'getorderadd']);

    Route::get('/admin-users', [AdminController::class, 'getusers']);
    Route::get('/admin-user-add', [AdminController::class, 'getuseradd']);
    Route::post('/admin-user-add', [AdminController::class, 'postuseradd'])->name('useradd');
    Route::get('/admin-users-delete-{id}', [AdminController::class, 'getuserdelete'])->name('getuserdelete');
    Route::post('/admin-user-edit-{id}', [AdminController::class, 'postuseredit'])->name('postuseredit');
    Route::get('/admin-users-edit-{id}', [AdminController::class, 'getuseredit'])->name('getuseredit');


});
