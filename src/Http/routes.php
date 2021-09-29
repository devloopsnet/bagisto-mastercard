<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('mastercard')
         ->group(function () {
             Route::get('/redirect/{cart}', 'Devloops\MasterCard\Http\Controllers\MasterCardController@redirect')
                  ->name('mastercard.redirect');

             Route::get('/success/{cart}', 'Devloops\MasterCard\Http\Controllers\MasterCardController@success')
                  ->name('mastercard.success');

             Route::get('/cancel/{cart}', 'Devloops\MasterCard\Http\Controllers\MasterCardController@cancel')
                  ->name('mastercard.cancel');
         });
});