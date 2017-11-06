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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('/leads',['as' => 'cms.lead', 'uses'=>'LeadController@getLead']);
Route::get('/ajaxLead', ['as' =>'cms.getLeadsAjax', 'uses' => 'LeadController@ajaxLead']);
Route::post('/leads-search',['as' => 'cms.lead_search', 'uses'=>'LeadController@postSearch']);
Route::get('/search-result', ['as' => 'cms.result' , 'uses'=>'LeadController@getResult']);
Route::post('/download', ['as' => 'cms.download', 'uses' => 'LeadController@postDownload']);