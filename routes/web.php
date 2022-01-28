<?php

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

Route::get('/', [App\Http\Controllers\EmployeeController::class, 'lists'])->name('lists');
Route::get('/new-employee', [App\Http\Controllers\EmployeeController::class, 'employeeAdd'])->name('new-employee');
Route::post('/new-employee', [App\Http\Controllers\EmployeeController::class, 'employeeNew']);

Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'employeeEdit'])->name('edit-employee');
Route::put('/edit-employee', [App\Http\Controllers\EmployeeController::class, 'employeeUpdate']);

Route::get('/delete-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'employeeDelete'])->name('delete-employee');
