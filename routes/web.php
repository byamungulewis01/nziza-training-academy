<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::controller(RequestsController::class)->group(function () {
    Route::get('/quote', 'quote')->name('quote');
    Route::post('/quote', 'storeQuote')->name('storeQuote');
    Route::get('/demo', 'demo')->name('demo');
    Route::post('/demo', 'storeDemo')->name('storeDemo');
    Route::get('/career', 'job')->name('job');
    Route::post('/career', 'storeJob')->name('storeJob');
});


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::resource('employees', UserController::class);
    Route::resource('course', CourseController::class);
    Route::resource('licence', LicenceController::class);
    Route::resource('branch', BranchController::class);
    Route::resource('invoice', InvoiceController::class);

    Route::controller(RequestsController::class)->prefix('request')->name('request.')->group(function () {
        Route::get('/demostration', 'demostration')->name('demostration');
        Route::get('/quotation', 'quotation')->name('quotation');
        Route::get('/careers', 'careers')->name('careers');
    });

});

require __DIR__ . '/auth.php';
