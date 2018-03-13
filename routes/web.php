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
Route::get('/info',['as'=>'Project.info','uses'=>'MainController@info']); 


Route::get('/',['as'=>'Project.index','uses'=>'MainController@index']); 
Route::get('/map',['as'=>'Project.map','uses'=>'MainController@map']);

Route::get('/dashboard',['as'=>'Project.dashboard','uses'=>'MainController@indexdashboard']);
Route::get('/checksatellite',['as'=>'Project.checksatellite','uses'=>'MainController@checksatellite']);
Route::get('/member',['as'=>'Project.member','uses'=>'UserController@member']);
Route::get('/control',['as'=>'Project.control','uses'=>'MainController@control']);
Route::get('/index',['as'=>'Project.index1','uses'=>'MainController@index1']);
Route::get('/test',['as'=>'Project.test','uses'=>'MainController@test']);

Route::get('/PhotoGallery',['as'=>'Project.PhotoGallery','uses'=>'PhotoController@PhotoGallery']);
Route::post('/PhotoGallery',['as'=>'Project.findPhoto','uses'=>'PhotoController@findPhoto']);
Route::post('/AddPhoto',['as'=>'Project.AddPhoto','uses'=>'PhotoController@AddPhoto']);

Route::get('/SoundArchive',['as'=>'Project.SoundArchive','uses'=>'SoundController@SoundArchive']);
Route::post('/SoundArchive',['as'=>'Project.findSound','uses'=>'SoundController@SoundArchive']);
Route::post('/AddSound',['as'=>'Project.AddSound','uses'=>'SoundController@AddSound']);

Route::get('/logCollection',['as'=>'Project.logCollection','uses'=>'MainController@logCollection']);
Route::get('/test',['as'=>'Project.test','uses'=>'MainController@test']);

Route::get('/login',['as'=>'Project.login','uses'=>'UserController@login']);
Route::post('/login',['as'=>'Project.login','uses'=>'UserController@checklogin']);

Route::get('/logout',['as'=>'Project.logout','uses'=>'UserController@logout']);

Route::get('/checktle',['as'=>'Project.checktle','uses'=>'MainController@checktle']);

Route::get('/register',['as'=>'Project.register','uses'=>'UserController@register']);
Route::post('/createuser',['as'=>'Project.createuser','uses'=>'UserController@createuser']);
Route::get('/tle',['as'=>'Project.tle','uses'=>'TLEController@showtle']);
Route::post('/addTLE',['as'=>'Project.addTLE','uses'=>'TLEController@addTLE']);
Route::post('/updateTLE',['as'=>'Project.updateTLE','uses'=>'TLEController@updateTLE']);


Route::get('/position',['as'=>'Project.position','uses'=>'PositionController@position']);
Route::post('/position',['as'=>'Project.positionSelect','uses'=>'PositionController@positionSelect']);

Route::post('/settingPassword',['as'=>'Project.settingPassword','uses'=>'UserController@settingPassword']);

Route::post('/submitEditProfile',['as'=>'Project.submitEditProfile','uses'=>'UserController@submitEditProfile']);

Route::post('/test',['as'=>'Project.testupload','uses'=>'MainController@testupload']);