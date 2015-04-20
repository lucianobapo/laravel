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

//after filter
//Route::filter('log', function($route,$request,$response){
//    //var_dump($route);
//    //var_dump($request);
//    //var_dump($response);
//});

Route:get('foo', 'FooController@foo');
//Route:get('foo', 'FooController@foo')->after('log');

Route::get('relatorios', ['as'=>'relatorios.index', 'uses'=>'RelatoriosController@index']);

Route::get('/', ['as'=>'index', 'uses'=>'WelcomeController@index']);

Route::get('home', ['as'=>'home.index', 'uses'=>'HomeController@index']);

//Route::controller('auth', 'Auth\AuthController', [
//    'names' => [
//        'auth/login'=>'auth.login',
//        'register'=>'auth.register',
//        'logout'=>'auth.logout',
//    ],
//]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('contact', ['as'=>'contact', 'uses'=>'PagesController@contact']);

Route::get('about', ['as'=>'about', 'uses'=>'PagesController@about']);

//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//Route::get('articles/{id}', 'ArticlesController@show');
//Route::post('articles', 'ArticlesController@store');
//Route::get('articles/{id}/edit', 'ArticlesController@edit');

Route::resource('articles','ArticlesController', [
    'names' => [
        'index'=>'articles.index',
        'show'=>'articles.show',
        'create'=>'articles.create',
        'store'=>'articles.store',
        'edit'=>'articles.edit',
        'update'=>'articles.update',
    ],
    'only'=>[
        'index',
        'show',
        'create',
        'store',
        'edit',
        'update',
    ],
]);

Route::get('tags/{tags}', ['as'=>'tags.show', 'uses'=>'TagsController@show']);