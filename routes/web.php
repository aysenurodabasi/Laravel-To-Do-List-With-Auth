<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', array('as'=>'index','uses'=>'HomeController@index'));
Route::post('/add', array('as'=>'add','uses'=>'HomeController@postAdd'));
Route::get('/delete/{id?}', array('as'=>'delete','uses'=>'HomeController@getDelete'));
Route::get('/update/{id?}', array('as'=>'update','uses'=>'HomeController@getUpdate'));
Route::post('/update/{id?}', array('as'=>'update','uses'=>'HomeController@postUpdate'));