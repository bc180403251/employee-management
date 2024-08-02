<?php

use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\EmployeeController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

//    Company Cruds Routes
    Route::get('companies/list',[CompanyController::class,'index'])->name('companies.list');
    Route::get('companies/listAll',[CompanyController::class, 'getCompanies'])->name('companies.listAll');
    Route::post('companies/create',[CompanyController::class ,'store'])->name('companies.create');
    Route::get('companies/show/{id}',[CompanyController::class, 'show'])->name('companies.show');
    Route::delete('companies/delete/{id}',[CompanyController::class,'destroy'])->name('companies.delete');
    Route::get('companies/update/{id}',[CompanyController::class, 'edit'])->name('companies.edit');
    Route::patch('companies/update/{id}',[CompanyController::class,'update'])->name('companies.update');

//    Employee CRUDS Route
    Route::get('employees/list',[EmployeeController::class, 'index'])->name('employees.list');
    Route::get('employees/getCreate',[EmployeeController::class ,'create'])->name('employees.getCreate');
    Route::post('employees/create',[EmployeeController::class,'store'])->name('employees.create');
    Route::get('employees/show/{id}',[EmployeeController::class,'show'])->name('employees.show');
});
