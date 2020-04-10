<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('user/{id}', 'teste@show');
*/
$router->put('/account/deposit/{id}', 
	['as' => 'deposit', 'uses' => 'accountController@deposit']);
$router->put('account/withdrawal/{id}', 'accountController@withdrawal');
$router->get('account/deposit/show/{id}', ['as' => 'inicio', 'uses' => 'accountController@showdeposit']);
$router->get('account/withdrawal/show/{id}', 'accountController@showwithdrawal');
$router->get('historic/list/{id}', 'historicController@moviment');
$router->put('bitcoin/purchase/{id}', 'bitcoinController@purchase');
$router->put('bitcoin/sale/{id}', 'bitcoinController@sale');
$router->get('bitcoin/purchase/show/{id}', 'bitcoinController@showpurchase');
$router->get('bitcoin/sale/show/{id}', 'bitcoinController@showsale');
$router->get('bitcoin/price/{id}', 'bitcoinControlere@price');
$router->get('bitcoin/historic/{id}', 'InvestmentController@moviment');


//$router->get('extract/account/show/{id}', 'ExtractController@account');
$router->get('extract/bitcoin/show/{id}', 'ExtractController@showbitcoin');
$router->get('extract/bitcoin/json/{id}', ['as' => 'jsonb', 'uses' => 'ExtractController@jsonbitcoin']);




$router->get('user/{id}', 'teste@show');

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
   $router->post('register', 'AuthController@register');
     // Matches "/api/login
    $router->post('login', 'AuthController@login');
    $router->get('login', 'AuthController@login');


    // Matches "/api/profile
    $router->get('profile', 'UserController@profile');

    // Matches "/api/user 
    //get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // Matches "/api/users
    $router->get('users', 'UserController@allUsers');
});

$router->get('/',  'AuthController@index');
$router->get('/logout',  'AuthController@logout');

