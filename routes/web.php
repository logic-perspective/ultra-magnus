<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'domain-analysis'], function () {
    Route::post('score', 'DomainAnalysisController@getScore')
        ->name('domain.score');

    Route::post('cname', 'DomainAnalysisController@getCname')
        ->name('domain.cname');
});

Route::post('/mx-analysis/record', 'MxAnalysisController@getRecords')
    ->name('mx.record');

Route::post('/email-analysis/headers', 'EmailAnalysisController@getHeaders')
    ->name('email.analysis.headers');

Route::group(['prefix' => 'dmarc-analysis'], function () {
    Route::post('/record', 'DmarcAnalysisController@getRecord')
        ->name('dmarc.record');

    Route::post('/analysis', 'DmarcAnalysisController@getAnalysis')
        ->name('dmarc.analysis');
});

Route::group(['prefix' => 'spf-analysis'], function () {
    Route::post('/record', 'SpfAnalysisController@getRecord')
        ->name('spf.record');

    Route::post('/tree', 'SpfAnalysisController@getTree')
        ->name('spf.tree');

    Route::post('/analysis', 'SpfAnalysisController@getAnalysis')
        ->name('spf.analysis');
});

Route::group(['prefix' => 'dkim-analysis'], function () {
    Route::post('/key', 'DkimAnalysisController@getKey')
        ->name('dkim.key');

    Route::post('/nameservers', 'DkimAnalysisController@getNameServerRecords')
        ->name('dkim.nameservers');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('admin');
    })->name('admin');

    Route::group(['prefix' => 'referrer'], function () {
        Route::post('token/generate', 'ReferrerController@getToken')
            ->name('referrer.token.generate');

        Route::post('token/change/{id}', 'ReferrerController@changeToken')
            ->name('referrer.token.change');

        Route::delete('token/destroy/{id}', 'ReferrerController@destroyToken')
            ->name('referrer.token.destroy');

        Route::post('email/change/{id}', 'ReferrerController@changeEmail')
            ->name('referrer.email.change');
    });
});








