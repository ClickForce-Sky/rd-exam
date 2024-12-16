<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::fallback(function () {
    abort(404, __('查無此API'));
});

Route::prefix('v1')->group(function () {
    Route::get('/test1', [App\Http\Controllers\Api\ExamController::class, 'test1'])->middleware('checkAuth:none');
    Route::get('/test2', [App\Http\Controllers\Api\ExamController::class, 'test2'])->middleware('checkAuth:admin|test2');
    Route::get('/test3', [App\Http\Controllers\Api\ExamController::class, 'test3'])->middleware('checkAuth:none');
});