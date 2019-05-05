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

Route::group(['middleware' => ['auth']], function()
{
	Route::get('/', function () {
	    return view('welcome');
	})->name('home');

    Route::group(['prefix' => '/telco'], function()
	{
		Route::get('/', 'TelcoController@index')->name('telco_list');

		Route::get('/add', 'TelcoController@showAddForm')->name('telco_add');
		Route::post('/add', 'TelcoController@add');

		Route::get('/edit/{id}', 'TelcoController@showEditForm')->name('telco_edit');
		Route::post('/edit/{id}', 'TelcoController@edit')->where('id', '[0-9]+');	

		Route::post('/delete', 'TelcoController@delete')->name('telco_delete');
	});

	Route::group(['prefix' => '/topup'], function()
	{
		Route::get('/danh-sach-don-upload', 'TopupController@upload_list')->name('topup_upload_list');
		Route::get('/upload', 'TopupController@showUploadForm')->name('topup_upload');
		Route::post('/upload', 'TopupController@upload');

		Route::get('/tra-truoc', 'TopupController@showTopupTraTruocForm')->name('topup_tra_truoc');
		Route::get('/tra-sau', 'TopupController@showTopupTraSauForm')->name('topup_tra_sau');		
		Route::get('/danh-sach-topup-mobile', 'TopupController@topup_list')->name('topup_list');
		Route::post('/topup-mobile', 'TopupController@topup')->name('topup_mobile');
	});
});
