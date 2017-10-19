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

Route::get('/clients', [
    'uses' => 'clientController@getClients'
]);

Route::get('/client/{id}', [
    'uses' => 'clientController@getClientById'
]);

Route::post('/client', [
    'uses' => 'clientController@postClient'
]);

Route::put('/client/{id}', [
    'uses' => 'clientController@putClient'
]);

Route::delete('/client/{id}', [
    'uses' => 'clientController@deleteClient'
]);


