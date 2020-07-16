<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'bookmarks', 'as' => 'bookmarks.'], function () {
    Route::post('/', 'BookmarkController@make')->name('store');
    Route::get('/', 'BookmarkController@list')->name('list');
    Route::get('/search', 'BookmarkController@search')->name('search');
    Route::get('/report', 'ReportsController@make')->name('report');
    Route::get('/{bookmark}', 'BookmarkController@show')->name('show');
});

Route::get('/reports', 'ReportsController@list')->name('reports.list');
