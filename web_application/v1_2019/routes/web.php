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

// Route for test
// TODO: DELETE

Route::get('api/test', 'ClientAPIController@test');

Route::get('master', function () {
    return view('layouts.master');
});

Route::middleware('auth')->group(function(){
    // Commodity
    Route::prefix('commodity')->group(function(){
        Route::get('create', 'CommodityController@create')->name('commodity_create');
        Route::post('store', 'CommodityController@store')->name('commodity_store');
    });

    // Distributor
    Route::prefix('distributor')->group(function(){
        Route::get('', 'DistributorController@index')->name('distributor_index');
        Route::get('create', 'DistributorController@create')->name('distributor_create');
        Route::post('store', 'DistributorController@store')->name('distributor_store');
    });

    // Retailer
    Route::prefix('retailer')->group(function(){
        Route::get('', 'RetailerController@index')->name('retailer_index');
        Route::get('create', 'RetailerController@create')->name('retailer_create');
        Route::post('store', 'RetailerController@store')->name('retailer_store');
    });

    // Ship
    Route::prefix('shipment')->group(function(){
        Route::get('create', 'ShipmentController@create')->name('shipment_create');
        Route::post('store', 'ShipmentController@store')->name('shipment_store');
        Route::put('delivered', 'ShipmentController@delivered')->name('shipment_delivered');
    });

    // QR code
    Route::prefix('qr-code')->group(function(){
        Route::get('', 'QrCodeParcelController@index')->name('qrcode_index');
        Route::get('create', 'QrCodeParcelController@create')->name('qrcode_create');
        Route::post('store', 'QrCodeParcelController@store')->name('qrcode_store');
        Route::put('export', 'QrCodeParcelController@export')->name('qrcode_export');
        Route::get('update-status-used/{id}', 'QrCodeParcelController@updatesusedtatus')->name('qrcode_update_used');

    });

    Route::get('supply-chain', 'ServiceSupplyChainController@supplychain')->name('supply_chain');
    Route::get('/', function () {
        return redirect()->route('supply_chain');
    });
    Route::get('home', function () {
        return redirect()->route('supply_chain');
    });

    Route::get('change-password', 'AuthController@changepasswordshow')->name('changepassword_show');
    Route::post('change-password', 'AuthController@changepasswordupdate')->name('changepassword_update');
    
});

Route::get('trace/{code?}', 'ClientAPIController@trace')->name('trace');
Route::get('transaction/{transactionId?}', 'ClientAPIController@transaction')->name('transaction');

Auth::routes();