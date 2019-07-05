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
$router->get('/tanamidia/links',"WordAnnotationController@getAll");

$router->group(['prefix' => "/tanamidia/link"], function() use ($router){
    $router->get('/{id}',"WordAnnotationController@get");
    $router->post('/',"WordAnnotationController@store");
    $router->put('/{id}',"WordAnnotationController@update");
    $router->delete('/{id}',"WordAnnotationController@destroy");
});

$router->post('/googlevision',"WordAnnotationController@googlevision");


// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });
