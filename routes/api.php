<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Customer')->prefix('customer')->group(function() {
    Route::post('', CreateController::class);
    Route::patch('{customer}', EditController::class);
});

Route::namespace('Transaction')->prefix('transaction')->group(function() {
    Route::post('{customer}/deposit', DepositController::class);
    Route::post('{customer}/withdraw', WithdrawController::class);
});

Route::get('report/{from}/{to}', ReportingController::class)->where([
    'from' => '\d{4}-\d{2}-\d{2}',
    'to' => '\d{4}-\d{2}-\d{2}',
]);
