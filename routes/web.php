<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/catalogue', [CatalogueController::class, 'catalogue'])->name('catalogue');
Route::view('/', 'index')->name('index');

Route::middleware(['auth'])->group(function () {
    //RUTA DEL INDEX
    Route::view('/main', 'main')->name('main');

    //RUTAS DE ADMINISTRADOS
    Route::middleware(['admin'])->group(function () {
        Route::view('/employee', 'employee.show')->name('employee.show');
        Route::view('/employee/create', 'employee.create')->name('employee.create');
        Route::view('/client', 'client.show')->name('client.show');
        Route::view('/client/create', 'client.create')->name('client.create');
        Route::view('/designer', 'designer.show')->name('designer.show');
        Route::view('/design', 'design.show')->name('design.show');
        Route::view('/inventory', 'inventory.show')->name('inventory.show');
        Route::view('/inventory/create', 'inventory.create')->name('inventory.create');
        Route::view('/sales', 'sales.show')->name('sales.show');

        // REPORTES
        Route::get('/report/employees', [ReportController::class, 'employees'])->name('report.employees');
        Route::get('/report/clients', [ReportController::class, 'clients'])->name('report.clients');
        Route::get('/report/designers', [ReportController::class, 'designers'])->name('report.designers');
        Route::get('/report/inventory', [ReportController::class, 'inventory'])->name('report.inventory');
        Route::get('/report/sales', [ReportController::class, 'sales'])->name('report.sales');

        Route::get('/report/audits', [ReportController::class, 'audits'])->name('report.audits');
        
    });

    //RUTAS DE INVETARIO
    Route::middleware(['inventory'])->group(function () {
        Route::view('/employee/inventory', 'inventory.show')->name('employee-inventory.show');
        Route::view('/employee/inventory/create', 'inventory.create')->name('employee-inventory.create');

    });

    //RUTAS DE VENDEDORES
    Route::middleware(['vendor'])->group(function () {
        Route::view('/vendor/sales', 'sales.show')->name('vendor-sales.show');
        Route::view('/vendor/inventory', 'inventory.show')->name('vendor-inventory.show');
        Route::view('/vendor/design', 'design.show')->name('vendor-design.show');
    });  
});



