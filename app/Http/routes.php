<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->post('login', function() use($app) {
    $credentials = app()->make('request')->input("credentials");
    return $app->make('App\Auth\Proxy')->attemptLogin($credentials);
});

$app->post('oauth/access-token', function() use($app) {
    return response()->json($app->make('oauth2-server.authorizer')->issueAccessToken());
});

$app->post('refresh-token', function() use($app) {
    return $app->make('App\Auth\Proxy')->attemptRefresh();
});

$app->group(['middleware' => 'oauth'], function($app)
{
	resource('user', 'UserController');
});


function resource($uri, $controller)
{
	global $app;
	
	$app->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
	$app->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
	$app->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
	$app->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
	$app->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');
}

