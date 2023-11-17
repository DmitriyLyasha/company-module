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
    Route::get('/companies', 'CompanyController@index')->withoutMiddleware('auth');
    Route::get('/companies/{id}', 'CompanyController@show')->withoutMiddleware('auth');
    Route::get('/employees', 'EmployeeController@index')->withoutMiddleware('auth');
    Route::get('/employees/{id}', 'EmployeeController@show')->withoutMiddleware('auth');
    Route::get('/projects', 'ProjectController@index')->withoutMiddleware('auth');
    Route::get('/projects/{id}', 'ProjectController@show')->withoutMiddleware('auth');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('companies', 'CompanyController')->except(['index', 'show']);;
        Route::apiResource('employees', 'EmployeeController')->except(['index', 'show']);;
        Route::apiResource('projects', 'ProjectController')->except(['index', 'show']);;
    });
});
