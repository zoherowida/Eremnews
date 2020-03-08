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

Route::name('web.')->group(static function () {

    Route::get('/', [
        'as' => 'index',
        'uses' => 'WebController@index',
    ]);
    Route::get('/home', [
        'as' => 'index',
        'uses' => 'WebController@index',
    ]);

    Route::get('products', [
        'as' => 'ajax.product',
        'uses' => 'WebController@ajaxProduct',
    ]);
    Route::get('products', [
        'as' => 'allproduct',
        'uses' => 'WebController@allProduct',
    ]);

    Route::get('product/{id}', [
        'as' => 'singleProduct',
        'uses' => 'WebController@singleProduct',
    ]);

    Route::group(['middleware' => 'auth'], function(){

        Route::resource('medicel', 'MedicalController', [
            'names' => [
                'index' => 'medicel',
                'store' => 'medicel.new',
                'destroy' => 'medicel.delete',
            ]
        ]);

        Route::get('ajax/product', [
            'as' => 'allProduct.ajax',
            'uses' => 'MedicalController@ajaxProduct',
        ]);


    });

});

Auth::routes();
