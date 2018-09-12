<?php

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

Route::get('/','Controller@index')->name('index');

Route::get('/departments','DepartmentsController@index')->name('departments');
Route::get('/departments/create','DepartmentsController@create')->name('departments.create');
Route::post('/departments/create','DepartmentsController@createRequest');
Route::get('/departments/edit/{id}','DepartmentsController@edit')
    ->where('id','\d+')
    ->name('departments.edit');
Route::post('/departments/edit/{id}','DepartmentsController@editRequest')
    ->where('id','\d+')
    ->name('departments.edit');
Route::delete('/departments/{id}','DepartmentsController@delete');



Route::get('/employees','EmployeesController@index')->name('employees');
Route::get('/employees/create','EmployeesController@create')->name('employees.create');
Route::post('/employees/create','EmployeesController@createRequest');
Route::get('/employees/edit/{id}','EmployeesController@edit')
    ->where('id','\d+')
    ->name('employees.edit');
Route::post('/employees/edit/{id}','EmployeesController@editRequest')
    ->where('id','\d+')
    ->name('employees.edit');
Route::delete('/employees/{id}','EmployeesController@delete');