<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route Auth
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('api.register');
    Route::post('/login', 'login')->name('api.login');
    Route::get('/user', 'getLoggedInUser')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->middleware('auth:sanctum')->name('api.logout');
});

//route CRUD Roles
Route::resource('roles', RolesController::class);


