<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);


Auth::routes();



Route::group(['middleware' => ['auth'], 'prefix' => 'portal'], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('roles/get-list',[App\Http\Controllers\RoleController::class, 'getAllRoles']);
    Route::resource('roles', \App\Http\Controllers\RoleController::class);

});

