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
| Users
*/
Route::resource('users', 'User\UserController');

/*
| Branches
*/
Route::resource('branches', 'Branch\BranchController', ['except' => ['create', 'edit']]);

/*
| Companies
*/
Route::resource('companies', 'Company\CompanyController', ['except' => ['create', 'edit']]);

/*
| Clients
*/
Route::resource('clients', 'Client\ClientController',['except' => ['create', 'edit']]);
Route::resource('clients.policies', 'Client\ClientPolicyController', ['only' => ['index', 'store']]);

/*
| Policys
*/
Route::resource('policies', 'Policy\PolicyController', ['except' => ['create', 'edit', 'store']]);
Route::resource('policies.receipts', 'Policy\PolicyReceiptController', ['only' => ['index']]);

/*
| Receipts
*/
Route::resource('receipts', 'Receipt\ReceiptController', ['except' => ['create','edit','store']]);


