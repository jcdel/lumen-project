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

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->post('auth/register', 'Auth\AuthController@register');
    $router->post('auth/login', 'Auth\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () use ($router) {
        
        Route::group(['namespace' => 'Auth'], function () use ($router) {

            $router->post('auth/logout', 'AuthController@logout');
        });

        Route::group(['namespace' => 'Api'], function () use ($router) {

            $router->group(['prefix' => 'users'], function () use ($router) {
    
                $router->get('/{id}', 'UserController@singleUser');
                $router->get('/', 'UserController@allUsers');
                $router->delete('/{id}', 'UserController@deleteUser');
        
            });
            
            $router->group(['prefix' => 'posts'], function () use ($router) {
        
                $router->get('/me', 'PostController@getUserPosts');
                $router->get('/', 'PostController@index');
                $router->get('/{id}', 'PostController@show');
                $router->put('/{id}', 'PostController@update');
                $router->delete('/{id}', 'PostController@delete');
                $router->post('/', 'PostController@store');
        
                $router->get('/{post_id}/comments', 'CommentController@show');
                $router->post('/{post_id}/comments', 'CommentController@store');
        
            });
    
        });

    });

});
