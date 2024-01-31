<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::get('/fruits', [AuthController::class, 'fruits']);
    Route::post('/fruits', [AuthController::class, 'fruits']);


});
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', [AuthController::class, 'create']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'create']);

Route::get('/getuser', [AuthController::class, 'getUser']);
