<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homepage/index');
});
//
Route::group(['prefix' => 'user'], function(){ 
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
     Route::post('/login', [AuthController::class, 'postLogin']); 
     Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
     Route::post('/register', [AuthController::class, 'postRegister']); 
    });
    Route::get('logout', [AuthController::class, 'getLogout'
]);

Route::get('rooms',  [HomeController::class, 'getrooms']

);

Route::get('introduction',  [HomeController::class, 'getintroduction']

);

Route::get('services',  [HomeController::class, 'getservices']

);

Route::get('details',  [HomeController::class, 'getdetails']

);

Route::get('contact',  [HomeController::class, 'getcontact']

);