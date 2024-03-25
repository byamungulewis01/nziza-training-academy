<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DairlyReportController;

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

Route::get('invoice-trainings', [InvoiceController::class, 'trainings'])->name('invoice.trainings');
Route::get('invoice-licenses', [InvoiceController::class, 'licenses'])->name('invoice.licenses');

Route::controller(DairlyReportController::class)->prefix('dairly-report')->name('dairly_report.')->group(function () {
    Route::post('/', 'report')->name('report');
    Route::patch('/update', 'report_update')->name('report_update');
    Route::patch('/comment', 'report_comment')->name('report_comment');
    Route::delete('/destroy/{id}', 'report_destroy')->name('report_destroy');

});
