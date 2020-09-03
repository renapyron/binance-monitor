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

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->get('/ping', 'PublicController@ping');
$router->get('/time', 'PublicController@time');

$router->group(['prefix' => 'balances'], function() use($router) {
    $router->get('/', 'BalancesController@list');
    $router->get('/{asset}', 'BalancesController@get');
});

$router->get('/asset-stats', 'HistoryController@assetStats');
