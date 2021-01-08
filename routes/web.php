<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('chicago-crime')->group(function () {
    Route::get('violent', 'ChicagoController@getViolentCrimeCount');
    Route::get('property', 'ChicagoController@getPropertyCrimeCount');
    Route::get('consensual', 'ChicagoController@getConsensualCrimeCount');
    Route::get('organised', 'ChicagoController@getOrganisedCrimeCount');
    Route::get('district-rates', 'ChicagoController@getDistrictRates');
});

Route::resource('chicago-crime', ChicagoController::class);

Route::resource('vancouver-crime', VancouverController::class);