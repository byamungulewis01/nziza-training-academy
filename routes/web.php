<?php

use App\Http\Controllers\MonthlyGoalsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\TraineesController;
use App\Http\Controllers\DairlyReportController;
use App\Http\Controllers\EmployeeProfileController;
use App\Http\Controllers\LicenseSubscriberController;
use App\Http\Controllers\TrainingSubscriberController;

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
    // return view('welcome');
    return to_route('login');
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
    Route::resource('client', ClientController::class);
    Route::get('invoice/download/{id}', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('invoice/print/{id}', [InvoiceController::class, 'print'])->name('invoice.print');
    Route::post('invoice/send-invoice/{id}', [InvoiceController::class, 'send_invoice'])->name('invoice.send_invoice');
    Route::get('invoice/quotation-invoice/{id}', [InvoiceController::class, 'quotation_invoice'])->name('invoice.quotation_invoice');

    Route::controller(EmployeeProfileController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/profile/{id}', 'profile')->name('profile');
        Route::get('/reports/{id}', 'reports')->name('reports');
        Route::get('/monthly-reports/{id}', 'monthly_reports')->name('monthly_reports');
        Route::get('/monthly-reports/review/{id}/{goal}', 'monthly_reports_review')->name('monthly_reports_review');
    });
    Route::controller(RequestsController::class)->prefix('request')->name('request.')->group(function () {
        Route::get('/demostration', 'demostration')->name('demostration');
        Route::get('/quotation', 'quotation')->name('quotation');
        Route::get('/quotation/create', 'create')->name('quotation.create');
        Route::get('/quotation/edit/{id}', 'edit')->name('quotation.edit');
        Route::get('/quotation/show/{id}', 'show')->name('quotation.show');
        Route::get('/quotation/download/{id}', 'download')->name('quotation.download');
        Route::post('/quotation/send-quotation/{id}', 'send_quotation')->name('quotation.send_quotation');
        Route::get('/quotation/print/{id}', 'print')->name('quotation.print');
        Route::post('/quotation/invoice/{id}', 'make_invoice')->name('quotation.make_invoice');
        Route::put('/quotation/update/{id}', 'update')->name('quotation.update');
        Route::delete('/quotation/destroy/{id}', 'destroy')->name('quotation.destroy');
        Route::get('/careers', 'careers')->name('careers');
    });
    Route::controller(DairlyReportController::class)->prefix('dairly-report')->name('dairly_report.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::resource('monthly_goals', MonthlyGoalsController::class);
    Route::put('monthly_goals/update_revenues/{id}', [MonthlyGoalsController::class, 'update_revenues'])->name('monthly_goals.update_revenues');


    Route::controller(RequestsController::class)->prefix('request')->name('request.')->group(function () {
        Route::get('/demostration', 'demostration')->name('demostration');
        Route::get('/quotation', 'quotation')->name('quotation');
        Route::get('/quotation/create', 'create')->name('quotation.create');
        Route::get('/quotation/edit/{id}', 'edit')->name('quotation.edit');
        Route::get('/quotation/show/{id}', 'show')->name('quotation.show');
        Route::get('/quotation/download/{id}', 'download')->name('quotation.download');
        Route::put('/quotation/update/{id}', 'update')->name('quotation.update');
        Route::delete('/quotation/destroy/{id}', 'destroy')->name('quotation.destroy');
        Route::get('/careers', 'careers')->name('careers');
    });

    Route::resource('license-subscribers', LicenseSubscriberController::class);
    Route::resource('training-subscribers', TrainingSubscriberController::class);
    Route::resource('trainees', TraineesController::class);
    Route::resource('roles', RolesController::class);

});

require __DIR__ . '/auth.php';
