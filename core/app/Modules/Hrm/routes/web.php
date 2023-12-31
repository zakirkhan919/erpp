<?php
use App\Modules\Hrm\Http\Controllers\DepartmentController;
use App\Modules\Hrm\Http\Controllers\DesignationController;
use App\Modules\Hrm\Http\Controllers\EmployeeController;
use App\Modules\Hrm\Http\Controllers\RoasterController;
use App\Modules\Hrm\Http\Controllers\MiscellaneousController;
use App\Modules\Hrm\Http\Controllers\Provident_fundController;
use App\Modules\Hrm\Http\Controllers\PaymentController;
use App\Modules\Hrm\Http\Controllers\SalaryController;
use App\Modules\Hrm\Http\Controllers\EmployeeBankAccountDetailController;


use App\Modules\Hrm\Http\Controllers\AttendanceController;




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


    // roaster manage
    Route::get('roaster', 'RoasterController@index')->name('roaster');
    Route::post('get-roaster', 'RoasterController@getRoaster')->name('get-roaster'); // ajax request
    Route::get('add_roaster', 'RoasterController@addRoaster')->name('add_roaster');
    Route::post('submit-roaster', 'RoasterController@submitRoaster')->name('submit-roaster');

    Route::get('add_csv', 'RoasterController@addCsv')->name('add_csv');
    Route::post('submit_csv', 'RoasterController@submitCsv')->name('submit_csv');

    Route::get('roaster-swap', 'RoasterController@roasterSwap')->name('roaster_swap');
    Route::post('swap-submit', 'RoasterController@SwapSubmt')->name('swap.submit');
    Route::get('roaster-report', 'RoasterController@RoasterReport')->name('roaster_report');
    Route::post('report-search', 'RoasterController@RoasterReportSearch')->name('report_search');

    // attendance
    Route::get('attendance', 'AttendanceController@Attendance')->name('attendance');
    Route::post('attendance-list', 'AttendanceController@employeeList')->name('employee_list');
    Route::get('view-attendance', 'AttendanceController@ViewAttendance')->name('view_attendance');
    Route::post('submit-attendance', 'AttendanceController@SubmitAttendance')->name('submit_attendance');
    Route::post('get-attendance', 'AttendanceController@GetAttendance')->name('get_attendence');

     //Miscellaneous
     Route::get('miscellaneous', 'MiscellaneousController@miscellaneous')->name('miscellaneous');
     Route::get('add-miscellaneous', 'MiscellaneousController@addMiscellaneous')->name('add_miscellaneous');
     Route::post('submit-miscellaneous', 'MiscellaneousController@submitMiscellaneous')->name('submit-miscellaneous');
     Route::post('get-miscellaneous', 'MiscellaneousController@getMiscellaneous')->name('get-miscellaneous');
     Route::get('update-miscellaneous/{id}', 'MiscellaneousController@miscellaneousEdit')->name('miscellaneous-edit');
     Route::post('update-miscellaneous','MiscellaneousController@miscellaneousUpdate')->name('update-miscellaneous');
     Route::post('miscellaneous-delete', 'MiscellaneousController@miscellaneousDelete')->name('miscellaneous-delete'); // ajax request

    //Provident_fund
    Route::get('provident_fund', 'Provident_fundController@provident_fund')->name('provident_fund');
    Route::get('add-provident_fund', 'Provident_fundController@addProvident_fund')->name('add_provident_fund');
    Route::post('submit-provident_fund', 'Provident_fundController@submitProvident_fund')->name('submit-provident_fund');
    Route::post('get-provident_fund', 'Provident_fundController@getProvident_fund')->name('get-provident_fund');
    Route::get('update-provident_fund/{id}', 'Provident_fundController@provident_fundEdit')->name('provident_fund-edit');
    Route::post('update-provident_fund','Provident_fundController@provident_fundUpdate')->name('update-provident_fund');
    Route::post('provident_fund-delete', 'Provident_fundController@provident_fundDelete')->name('provident_fund-delete'); // ajax request

    //salary
    Route::get('salary', 'SalaryController@salary')->name('salary');
    Route::get('add-salary', 'SalaryController@addSalary')->name('add_salary');
    Route::post('submit-salary', 'SalaryController@submitSalary')->name('submit-salary');
    Route::post('get-salary', 'SalaryController@getSalary')->name('get-salary');
    Route::post('salary-delete', 'SalaryController@salaryDelete')->name('salary-delete'); // ajax request


    //Payment
    Route::get('payment', 'PaymentController@payment')->name('payment');
    Route::get('add-payment', 'PaymentController@addPayment')->name('add_payment');
    Route::get('make-payment/{id}', 'PaymentController@makePayment')->name('make_payment');
    Route::post('submit-payment', 'PaymentController@submitPayment')->name('submit-payment');
    Route::post('get-payment', 'PaymentController@getPayment')->name('get-payment');
    Route::get('update-payment/{id}', 'PaymentController@paymentEdit')->name('payment-edit');
    Route::post('update-payment','PaymentController@paymentUpdate')->name('update-payment');
    Route::post('payment-delete', 'PaymentController@paymentDelete')->name('payment-delete'); // ajax request

    //bank
    Route::get('bank_detail', 'EmployeeBankAccountDetailController@bank_detail')->name('bank_detail');
    Route::get('add-bank_detail', 'EmployeeBankAccountDetailController@addBank_detail')->name('add_bank_detail');
    Route::post('submit-bank_detail', 'EmployeeBankAccountDetailController@submitBank_detail')->name('submit-bank_detail');
    Route::post('get-bank_detail', 'EmployeeBankAccountDetailController@getBank_detail')->name('get-bank_detail');
    Route::get('edit-bank_detail/{id}', 'EmployeeBankAccountDetailController@bank_detailEdit')->name('bank_detail-edit');
    Route::post('update-bank_detail','EmployeeBankAccountDetailController@bank_detailUpdate')->name('update-bank_detail');
    Route::post('bank_detail-delete', 'EmployeeBankAccountDetailController@bank_detailDelete')->name('bank_detail-delete'); // ajax request

});
