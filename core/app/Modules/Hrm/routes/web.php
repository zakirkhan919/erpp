<?php
use App\Modules\Hrm\Http\Controllers\DepartmentController;
use App\Modules\Hrm\Http\Controllers\DesignationController;
use App\Modules\Hrm\Http\Controllers\EmployeeController;

// Admin Route
Route::group(['middleware' => 'auth'], function () {

    //Holidayes maintence
    Route::get('holiday', 'HolidayController@Holiday')->name('holiday');
    Route::get('add-holiday', 'HolidayController@addHoliday')->name('add_holiday');
    Route::post('submit-fixed-holiday', 'HolidayController@SubmitFixedHoliday')->name('submit-fixed-holiday');
    Route::post('submit-occasion-holiday', 'HolidayController@SubmitOccasionHoliday')->name('submit-occasion-holiday');
    Route::get('get-holiday', 'HolidayController@getHoliday')->name('get-holiday');

    //Department
    Route::get('department', 'DepartmentController@department')->name('department');
    Route::get('add-department', 'DepartmentController@addDepartment')->name('add_department');
    Route::post('submit-department', 'DepartmentController@submitDepartment')->name('submit-department');
    Route::post('get-department', 'DepartmentController@getDepartment')->name('get-department');
    Route::post('department-edit','DepartmentController@departmentEdit')->name('department-edit');
    Route::post('department-delete', 'DepartmentController@departmentDelete')->name('department-delete'); // ajax request

    //Designation
    Route::resource('designations', DesignationController::class);

    //Employee
    Route::resource('employees', EmployeeController::class);

});
