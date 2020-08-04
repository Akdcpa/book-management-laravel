<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('register', 'AuthController@store');

}); 


Route::group([
    'middleware' => 'auth:api',
    'prefix'=>'books'
], function () {
    Route::post('create', 'BookController@create'); 
    Route::post('update', 'BookController@update'); 
    Route::post('delete/soft', 'BookController@softdelete'); 
    Route::post('delete/hard', 'BookController@harddelete'); 
    Route::get('get', 'BookController@get'); 
    Route::get('send', 'JobController@send');  
    Route::get('email-test', function(){ 
        $details['email'] = 'akgit2000@gmail.com'; 
        dispatch(new App\Jobs\SendEmailJob($details)); 
        dd('done'); 
    });

});

