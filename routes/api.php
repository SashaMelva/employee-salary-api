<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HourlyRateController;
use App\Http\Controllers\StatusTransactionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::resource('/employee', EmployeeController::class)->except([
    'create', 'edit'
]);

Route::resource('/transaction', TransactionController::class)->except([
    'create', 'edit'
]);

Route::resource('/statusTransaction', StatusTransactionController::class)->except([
    'create', 'edit'
]);

Route::resource('/hourlyRate', HourlyRateController::class)->except([
    'create', 'edit'
]);

URL::forceScheme('https');
