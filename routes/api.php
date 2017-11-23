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
/*
| Resources routes
*/

/*
| Api Resource basic routes
*/
Route::apiResources([
    'users' => 'User\UserController',
    'branches' => 'Branch\BranchController',
    'companies' => 'Company\CompanyController',
    'clients' => 'Client\ClientController'
]);

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









