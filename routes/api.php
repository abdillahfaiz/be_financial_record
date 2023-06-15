<?php

use App\Http\Controllers\Api\FinancialRecordController;
use App\Http\Resources\FinancialRecordsResource;
use App\Models\FinancialRecord;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('/data', FinancialRecordController::class);
Route::get('/data', [FinancialRecordController::class, 'index']);
Route::post('/create', [FinancialRecordController::class, 'store']);
Route::put('/data/update/{id}', [FinancialRecordController::class, 'update']);
Route::delete('/data/delete/{id}', [FinancialRecordController::class, 'destroy']);
Route::get('/total', [FinancialRecordController::class, 'total']);
