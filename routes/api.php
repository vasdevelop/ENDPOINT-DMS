<?php

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



// Route::get('/get-province', 'App\Http\Controllers\api\HomeAPIController@getProvince');
Route::post('/documents', 'App\Http\Controllers\api\HomeAPIController@documents');
Route::post('/stamped-documents', 'App\Http\Controllers\api\HomeAPIController@stampedDocument');
Route::put('/documents', 'App\Http\Controllers\api\HomeAPIController@downloadDocuments');
Route::post('/check-documents', 'App\Http\Controllers\api\HomeAPIController@checkDocuments');
Route::patch('/documents', 'App\Http\Controllers\api\HomeAPIController@deleteDocuments');



