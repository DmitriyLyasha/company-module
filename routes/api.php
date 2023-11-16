<?php

use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\ProjectController;
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


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::post('/login', 'AuthController@login');
    Route::get('/companies', 'CompanyController@index');
    Route::get('/companies/{id}', 'CompanyController@show');
    Route::get('/employees', 'EmployeeController@index');
    Route::get('/employees/{id}', 'EmployeeController@show');
    Route::get('/projects', 'ProjectController@index');
    Route::get('/projects/{id}', 'ProjectController@show');

    Route::middleware(['auth'])->group(function () {
        Route::apiResource('companies', 'CompanyController');
        Route::apiResource('employees', 'EmployeeController');
        Route::apiResource('projects', 'ProjectController');
    });
});
