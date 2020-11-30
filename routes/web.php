<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

use Illuminate\Support\Facades\Storage;

$router->get('/', ['as'=>'home', 'uses' =>'DashboardController@index']);

$router->delete('/profile/{name}', ['as'=>'profile.delete', 'middleware' => 'auth', 'uses' =>'ProfileController@delete']);
$router->get('/profile/{name}', ['as'=>'profile.get', 'middleware' => 'auth', 'uses' =>'ProfileController@get']);
$router->get('/profile/{name}/profile.conf', ['as'=>'profile.download', 'middleware' => 'auth', 'uses' =>'ProfileController@download']);
$router->post('/profile', ['as'=>'profile.post', 'middleware' => 'auth', 'uses' =>'ProfileController@post']);

$router->post('/login', ['as'=>'login', 'uses' =>'UserController@login']);
$router->get('/logout', ['as'=>'logout', 'uses' =>'UserController@logout']);

