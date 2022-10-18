<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
        'middleware' => ['cors'],
    ], function ($router) {
         Route::get('fetchProperties', 'FetchPropertyFromAPI@fetchProperties')->name('fetchProperties');

        Route::get('fetchPropertyDetails/{id}', 'FetchPropertyFromAPI@fetchPropertyDetails')->name('fetchPropertyDetails');

        Route::post('savePropertyDetails', 'FetchPropertyFromAPI@savePropertyDetails')->name('savePropertyDetails');

        Route::get('fetchPropertyTypes', 'FetchPropertyFromAPI@fetchPropertyTypes')->name('fetchPropertyTypes');
});

Route::get('fetchPropertiesFromApi', 'FetchPropertyFromAPI@fetchPropertiesFromApi')->name('fetchPropertiesFromApi');