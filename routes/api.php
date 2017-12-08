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

Route::group([
    'namespace' => 'Api'
], function() {
    Route::post('users/login', 'AuthController@login');
    Route::post('users', 'AuthController@register');

    Route::get('user', 'UserController@index');
    Route::match(['put', 'patch'], 'user', 'UserController@update');

    Route::get('profiles/{user}', 'ProfileController@show');
    Route::post('profiles/{user}/follow', 'ProfileController@follow');
    Route::delete('profiles/{user}/follow', 'ProfileController@unFollow');

//    Route::get('annotations/feed', 'FeedController@index');

    Route::resource('posts', 'PostController', [
        'except' => ['create', 'edit', 'udpate']]);
    Route::get('papers', 'PaperController@index');
    Route::post('papers', 'PaperController@add');

    Route::get('papers/{filename}', 'PaperController@show');
    Route::get('papers/{filename}/annotations', 'AnnotationController@index');
    Route::post('annotations', 'AnnotationController@store');
    Route::get('annotations/{id}', 'AnnotationController@show');

    Route::post('publications/{publication}/favorite', 'FavoriteController@add');
    Route::delete('publications/{publication}/favorite', 'FavoriteController@remove');

    Route::resource('publications', 'PublicationController', [
        'except' => ['store', 'create', 'edit', 'delete', 'update']
    ]);
    Route::get('journals', 'JournalController@index');
    Route::get('tags', 'TagController@index');
});