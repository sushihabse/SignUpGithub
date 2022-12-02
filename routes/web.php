<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;

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

Auth::routes();

Route::group(['as'=>'login.','prefix'=>'login'], function(){
    Route::get('/{provider}',[loginController::class,'redirctToProvider'])->name('provider');
    Route::get('/{provider}/callback',[loginController::class,'handleProviderCallback'])->name('provider.callback');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
