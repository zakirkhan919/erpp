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
    Route::post('get-holiday', 'HolidayController@getHoliday')->name('get-holiday');
    Route::post('update-occasion-holiday', 'HolidayController@updateOccasionHoliday')->name('update-occasion-holiday');
    //Department
    Route::get('department', 'DepartmentController@department')->name('department');
    Route::get('add-department', 'DepartmentController@addDepartment')->name('add_department');
    Route::post('submit-department', 'DepartmentController@submitDepartment')->name('submit-department');
    Route::post('get-department', 'DepartmentController@getDepartment')->name('get-department');
    Route::get('update-department/{id}', 'DepartmentController@departmentEdit')->name('department-edit');
    Route::post('update-department','DepartmentController@departmentUpdate')->name('update-department');
    Route::post('department-delete', 'DepartmentController@departmentDelete')->name('department-delete'); // ajax request

    //Designation
    Route::get('designation', 'DesignationController@designation')->name('designation');
    Route::get('add-designation', 'DesignationController@addDesignation')->name('add_designation');
    Route::post('submit-designation', 'DesignationController@submitDesignation')->name('submit-designation');
    Route::post('get-designation', 'DesignationController@getDesignation')->name('get-designation');
    Route::get('update-designation/{id}', 'DesignationController@designationEdit')->name('designation-edit');
    Route::post('update-designation','DesignationController@designationUpdate')->name('update-designation');
    Route::post('designation-delete', 'DesignationController@designationDelete')->name('designation-delete'); // ajax request

    Route::post('get-occasion-data', 'HolidayController@getOccasionHoliday')->name('get-occasion-data');
    Route::post('delete-occasion-data', 'HolidayController@deleteOccasionHoliday')->name('delete-occasion-data');    Route::get('employee', 'EmployeeController@employee')->name('employee');
    Route::get('add-employee', 'EmployeeController@addEmployee')->name('add_employee');
    Route::post('submit-employee', 'EmployeeController@submitEmployee')->name('submit-employee');
    Route::post('get-employee', 'EmployeeController@getEmployee')->name('get-employee');
    Route::get('update-employee/{id}', 'EmployeeController@employeeEdit')->name('employee-edit');
    Route::post('update-employee','EmployeeController@updateEmployee')->name('update-employee');
    Route::post('employee-delete', 'EmployeeController@employeeDelete')->name('employee-delete'); // ajax request

});
