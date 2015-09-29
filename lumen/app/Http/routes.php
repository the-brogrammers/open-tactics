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

$app->get('/', function () use ($app) {
    return 'OT';
    //return $app->welcome();
});

function rest($path, $controller)
{
	global $app;
	
	$app->get($path, $controller.'@index');
	$app->get($path.'/{id}', $controller.'@show');
	$app->post($path, $controller.'@store');
	$app->put($path.'/{id}', $controller.'@update');
	$app->delete($path.'/{id}', $controller.'@destroy');
}

$app->group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function($app)
{
	rest('/users', 'UserController');
});
