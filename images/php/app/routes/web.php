<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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


 $router->group(['prefix' => 'api'], function () use ($router) {
            $router->get('progress/{id}', ['uses' => 'SessionsController@getProgressHistory']);
            $router->get('categories/{id}', ['uses' => 'SessionsController@getLastSessionCategories']);
 });
