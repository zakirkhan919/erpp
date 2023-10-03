<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function Employeeadd($data)
    {
        // If the input field names in your HTML form are different from the column names in your database table,
        // you can manually map the data to the appropriate columns before using create().
        Employee::create([
            'name' => $data['name'],
            'fathers_name' => $data['fathers_name'],
            'mothers_name' => $data['mothers_name'],
            'date_of_birth' => $data['date_of_birth'],
            'photo' => $data['photo'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'department_id' => $data['department_id'],
            'designation_id' => $data['designation_id'],
            'joining_date' => $data['joining_date'],
            'joining_salary' => $data['joining_salary'],
            'medical_allowance' => $data['medical_allowance'],
            'provident_fund' => $data['provident_fund'],
            'house_rent' => $data['house_rent'],
            'incentive' => $data['incentive'],
            'insurance' => $data['insurance'],
            'tax' => $data['tax'],
        ]);
    }


    public static function Employeeupdated($id, $data)
    {
        $employee = Employee::find($id);
        $employee->fill($data);
        $employee->save();
    }

    public static function deleteEmployee($request)
    {
        $id = decrypt($request->id);
        $data = Employee::find($id);
        if ($data) {
            $data->delete();
        }
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id','id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'emp_id','id');
    }
    public function miscellaneous()
    {
        return $this->hasMany(Miscellaneous::class, 'employee_id','id');
    }

}
