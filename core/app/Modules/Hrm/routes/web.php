<?php

// Admin Route
Route::group(['middleware' => 'auth'], function () {

    //Holidayes maintence
    Route::get('holiday', 'HolidayController@Holiday')->name('holiday');
    Route::get('add-holiday', 'HolidayController@addHoliday')->name('add_holiday');
    Route::post('fixed-holiday', 'HolidayController@FixedHolidayStore')->name('fixed-holiday');
    Route::post('occasion-holiday', 'HolidayController@OccasionHolidayStore')->name('occasion-holiday');
    Route::get('get-holiday', 'HolidayController@getHoliday')->name('get-holiday');
});
