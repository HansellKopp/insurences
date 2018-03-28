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
/**
 * Search
 */
Route::get('clients/search', 'Client\ClientController@search');

/*
| Api Resource basic routes
*/
Route::apiResources([
    'branches' => 'Branch\BranchController',
    'companies' => 'Company\CompanyController',
    'clients' => 'Client\ClientController'
]);

/**
 * Branch policies
 */
Route::get('branches/{id}/policies', 'Branch\BranchPolicyController@index');
/**
 *  User Authentication routes
 */
Route::post('login', 'User\AuthController@login');
Route::post('logout', 'User\AuthController@logout');
Route::post('register', 'User\UserController@store');
Route::resource('users', 'User\UserController', ['only' => ['index', 'show','destroy']]);

/**
 * Retrive clients with birtdays between to dates
 */
Route::get('clients/birthdays','Client\ClientController@birthdays');

/**
 * Client documents resource
 */
Route::resource('clients.documents', 'Client\ClientDocumentController', ['only' => ['store', 'show','destroy']]);

/**
 * Store client's policies
 */
Route::post('clients.policies', 'Client\ClientPolicyController@store');

/**
 * Retrive company's policies
 */
Route::get('companies/{id}/policies', 'Company\CompanyPolicyController@index');

/*
| Policies resource partial methods
*/
Route::resource('policies', 'Policy\PolicyController', ['except' => ['store','create','edit']]);
/**
 * Retrive policies with expiration between to dates
 */
Route::get('policies/expirations','Policy\PolicyController@expirations');
Route::resource('policies.documents', 'Policy\PolicyDocumentController', ['except' => ['create', 'edit','update']]);

/*
| Receipts resource
*/
Route::resource('receipts', 'Receipt\ReceiptController', ['only' => ['show','update','destroy']]);

/**
 * Verify user email
 */
Route::name('user_verify')->get('users/verify/{token}','User\UserController@verify');









