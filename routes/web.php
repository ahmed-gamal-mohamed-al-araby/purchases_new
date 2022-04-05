<?php

use Reports\ReportController;
use Bank\BankController;
use DiscountType\DiscountTypeController;
use NatureDealing\NatureDealingController;
use Project\ProjectController;
use Supplier\SupplierController;
use BusinessNature\BusinessNatureController;
use Invoice\InvoiceController;
use PaymentInvoice\PaymentInvoiceController;
use Item\ItemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Auth::routes();


        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index');
        Route::resource('roles', RoleController::class);

        // users

        Route::resource('/users', 'User\UserController')->middleware('auth');
        Route::get('/users/profile/{id}', 'User\UserController@getProfile')->name('users.profile')->middleware('auth');

        // Items
        Route::resource('items', ItemController::class)->except('destroy');
        Route::get('/items/delete/{id}', "Item\ItemController@delete")->name('items.delete')->middleware('auth');

        // end Items

        // BusinessNature
        Route::resource('businessNature', BusinessNatureController::class)->except('destroy');
        Route::get('/businessNature/delete/{id}', "BusinessNature\BusinessNatureController@delete")->name('businessNature.delete')->middleware('auth');

        // end BusinessNature

        // Projects
        Route::resource('projects', ProjectController::class)->except('destroy');
        Route::get('/projects/delete/{id}', "Project\ProjectController@delete")->name('projects.delete')->middleware('auth');

        // end Projects

        // Supplier
        Route::resource('supplier', SupplierController::class)->except('destroy');
        Route::get('supplier/delete/{id}', "Supplier\SupplierController@delete")->name('supplier.delete')->middleware('auth');
        Route::get('supplier/fetch_data', "Supplier\SupplierController@fetch_data")->name('supplier_pagination_fetch_data')->middleware('auth');
        Route::get('/approve_supplier/{id}', "Supplier\SupplierController@approvesupplier")->name('approve_supplier')->middleware('auth');


        // excel
        Route::post('suppliers/importsupplier', "Supplier\SupplierController@importsupplier")->name('importsupplier');
        // end excel
        // end Supplier

        // DiscountType
        Route::resource('discountType', DiscountTypeController::class)->except('destroy');
        Route::get('/discountType/delete/{id}', "DiscountType\DiscountTypeController@delete")->name('discountType.delete')->middleware('auth');

        // end DiscountType


        // NatureDealing
        Route::resource('natureDealing', NatureDealingController::class)->except('destroy');
        Route::get('/natureDealing/delete/{id}', "NatureDealing\NatureDealingController@delete")->name('natureDealing.delete')->middleware('auth');

        // end NatureDealing

        // Bank
        Route::resource('bank', BankController::class)->except('destroy');
        Route::get('/bank/delete/{id}', "Bank\BankController@delete")->name('bank.delete')->middleware('auth');
        Route::get('/approve_bank/{id}', "Bank\BankController@approveBank")->name('approve_bank')->middleware('auth');

        // end Bank

        // Invoice
        Route::resource('invoice', InvoiceController::class)->except('destroy');
        Route::get('/invoice_get_data', "Invoice\InvoiceController@getInvoiceData")->name('invoice_get_project_data')->middleware('auth');
        Route::get('/invoice_get_data_supplier', "Invoice\InvoiceController@getInvoiceDataSupplier")->name('invoice_get_supplier')->middleware('auth');
        Route::get('/invoice_get_supplier_name', "Invoice\InvoiceController@getInvoiceSupplierName")->name('invoice_get_supplier_name')->middleware('auth');
        Route::get('/invoice_get_discount_type', "Invoice\InvoiceController@getInvoicediscountType")->name('invoice_get_discount_type')->middleware('auth');
        Route::get('/approve_invoice/{id}', "Invoice\InvoiceController@approveInvoice")->name('approve_invoice')->middleware('auth');
        Route::get('/invoice/delete/{id}', "Invoice\InvoiceController@delete")->name('invoice.delete')->middleware('auth');
        Route::get('/invoice_reviewing', "Invoice\InvoiceController@reviewing")->name('invoice.reviewing')->middleware('auth');
        Route::get('/invoice_reviewed', "Invoice\InvoiceController@reviewed")->name('invoice.reviewed')->middleware('auth');
        Route::get('/invoice_number_check', "Invoice\InvoiceController@invoiceNumberCheck")->name('invoice_number_check')->middleware('auth');

        // excel
        Route::post('invoice/importinvoice', "Invoice\InvoiceController@importinvoice")->name('importinvoice');
        // end excel

        // end Invoice

         // account statement
         Route::get('/get_supplier_statment', "AccountStatement\AccountStatementController@index")->name('report_get_supplier_statment')->middleware('auth');
         Route::post('/get_supplier_statment_report', "AccountStatement\AccountStatementController@show")->name('report_supplier_statment_ajax')->middleware('auth');
 
         // end account statement

        // PaymentInvoice
        Route::resource('paymentInvoice', PaymentInvoiceController::class)->except('destroy');
        Route::get('/payment_get_bank_data', "PaymentInvoice\PaymentInvoiceController@getPaymentBankData")->name('payment_get_bank_data')->middleware('auth');
        Route::get('/invoice_get_project_business_data', "PaymentInvoice\PaymentInvoiceController@getPaymentBankBusinessData")->name('invoice_get_project_business_data')->middleware('auth');
        Route::get('/approve_payment/{id}', "PaymentInvoice\PaymentInvoiceController@approvePayment")->name('approve_payment')->middleware('auth');
        Route::get('/paymentInvoice/delete/{id}', "PaymentInvoice\PaymentInvoiceController@delete")->name('payment.delete')->middleware('auth');
        Route::get('/paymentInvoice_with_receive', "PaymentInvoice\PaymentInvoiceController@with_receive")->name('payment.with_receive')->middleware('auth');
        Route::get('/paymentInvoice_without_receiving', "PaymentInvoice\PaymentInvoiceController@without_receiving")->name('payment.without_receiving')->middleware('auth');
        Route::get('/paymentInvoice_reviewing', "PaymentInvoice\PaymentInvoiceController@reviewing")->name('payment.reviewing')->middleware('auth');
        Route::get('/paymentInvoice_reviewed', "PaymentInvoice\PaymentInvoiceController@reviewed")->name('payment.reviewed')->middleware('auth');


        // end PaymentInvoice
        // Reports
        Route::resource('reports', ReportController::class)->except('destroy');

        Route::get('reports_general_conclusions', "Reports\ReportController@reportsGeneralConclusions")->name('reports.reports_general_conclusions')->middleware('auth');
        Route::get('reports_ack_added_value', "Reports\ReportController@ackAddedValue")->name('reports.ack_added_value')->middleware('auth');
        Route::get('reports_discount_taxes', "Reports\ReportController@discountTaxes")->name('reports.discount_taxes')->middleware('auth');

        Route::post('reports/ajax', "Reports\ReportController@report")->name('reports.ajax')->middleware('auth');
        Route::post('reports/general_conclusions', "Reports\ReportController@generalConclusionsAjax")->name('reports.general_conclusions.ajax')->middleware('auth');
        Route::post('reports/ack_added_value', "Reports\ReportController@ackAddedValueAjax")->name('reports.ack_added_value.ajax')->middleware('auth');
        Route::post('reports/ack_added_value_G_SH', "Reports\ReportController@ackAddedValueGSHAjax")->name('reports.ack_added_value_G_SH.ajax')->middleware('auth');
        Route::get('reports_ack_added_value_G_SH', "Reports\ReportController@ackAddedValueGSH")->name('reports.ack_added_value_G_SH')->middleware('auth');

        Route::post('reports/discount_taxes', "Reports\ReportController@discountTaxesAjax")->name('reports.discount_taxes.ajax')->middleware('auth');
    }
);
