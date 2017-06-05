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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers'], function ($api) {

    $api->post('login', 'ApiController@login');

    $api->post('register', 'ApiController@register');

    $api->group(['middleware' => ['jwt.auth']], function ($api){
        $api->get('users', 'UserController@index');
    });

    $api->get('images', 'ImageController@index');

    $api->get('todos', 'TodoController@index');
    $api->post('todos', 'TodoController@store');
    $api->get('todos/{id}', 'TodoController@show');
    $api->patch('todos/{id}', 'TodoController@update');
    $api->delete('todos/{id}', 'TodoController@delete');

});
