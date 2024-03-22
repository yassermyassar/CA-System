<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\customerscontroller;
use App\Http\Controllers\customersReportcontroller;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\invoices;
use App\Models\invoices_details;

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
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::resource('/invoices', InvoicesController::class);
Route::resource('/Archive', ArchiveController::class);
Route::get('/invoice_paid', [InvoicesController::class, 'invoice_paid']);
Route::get('/invoice_unpaid', [InvoicesController::class, 'invoice_unpaid']);
Route::get('/invoice_partial_paid', [InvoicesController::class, 'invoice_partial_paid']);
Route::resource('/sections', SectionsController::class);
Route::resource('/products', ProductsController::class);
Route::get('/section/{id}', [InvoicesController::class, 'getproduct']);
Route::get('/Print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'show'])->name('show');
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit'])->name('edit');
Route::get('/status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
Route::post('/status_update/{id}', [InvoicesController::class, 'status_update'])->name('status_Update');
Route::get('exportInvoices/', [InvoicesController::class, 'export'])->name('exportInvoices');
Route::get('customers_report', [customersReportcontroller::class, 'index']);
Route::get('markAsRead', [InvoicesController::class, 'markAsRead'])->name('markAsRead');
Route::post('Search_customers', [customersReportcontroller::class, 'Search_customers']);
Route::get('view/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'View_file']);
Route::post('delete', [InvoicesDetailsController::class, 'destroy'])->name('delete');
Route::get('Download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'download'])->name('download');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {


    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('invoicesReport', [ReportController::class, 'index']);
Route::post('Search_invoices', [ReportController::class, 'Search_invoices']);
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/{page}', [AdminController::class, 'index']);
