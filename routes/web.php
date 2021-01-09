<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('chicago-crime')->group(function () {
    Route::get('violent', 'ChicagoController@getViolentCrimeCount')->name('chicago-crime.violent');
    Route::get('property', 'ChicagoController@getPropertyCrimeCount')->name('chicago-crime.property');
    Route::get('consensual', 'ChicagoController@getConsensualCrimeCount')->name('chicago-crime.consensual');;
    Route::get('organised', 'ChicagoController@getOrganisedCrimeCount')->name('chicago-crime.organised');;
    Route::get('district-rates', 'ChicagoController@getDistrictRates')->name('chicago-crime.districts');;
});

