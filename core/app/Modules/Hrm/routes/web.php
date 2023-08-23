<?php

// Admin Route
Route::group(['middleware' => 'auth'], function () {

    //Holidayes maintence
    Route::get('holiday', 'HolidayController@Holiday')->name('holiday');
    Route::get('add-holiday', 'HolidayController@addHoliday')->name('add_holiday');
    Route::post('submit-fixed-holiday', 'HolidayController@SubmitFixedHoliday')->name('submit-fixed-holiday');
    Route::post('submit-occasion-holiday', 'HolidayController@SubmitOccasionHoliday')->name('submit-occasion-holiday');
    Route::post('get-holiday', 'HolidayController@getHoliday')->name('get-holiday');
    Route::post('update-occasion-holiday', 'HolidayController@updateOccasionHoliday')->name('update-occasion-holiday');
    Route::post('get-occasion-data', 'HolidayController@getOccasionHoliday')->name('get-occasion-data');
    Route::post('delete-occasion-data', 'HolidayController@deleteOccasionHoliday')->name('delete-occasion-data');
});
