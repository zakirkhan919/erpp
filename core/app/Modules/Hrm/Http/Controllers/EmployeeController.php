<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Department;
use App\Modules\Hrm\Models\Designation;
use App\Modules\Hrm\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Hrm::employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $designations = Designation::all();

        return view('Hrm::employee.add_employee', compact('departments', 'designations'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fathers_name' => 'required|string|max:255',
            'mothers_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,webp',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:11',
            'email' => 'nullable|email|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'joining_date' => 'required|date',
            'joining_salary' => 'required|numeric',
            'medical_allowance' => 'required|numeric',
            'provident_fund' => 'required|numeric',
            'house_rent' => 'required|numeric',
            'incentive' => 'required|numeric',
            'insurance' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);

        $employeeData = $request->except('photo');

    if ($request->has('photo') && $request->photo != '') {
        $path = 'assets/uploads/employees/' . date("Y") . "/" . date("m") . "/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            $new_file = fopen($path . '/index.html', 'w') or die('Cannot create file: [UC-1001]');
            fclose($new_file);
        }
        $root_path = CommonFunction::getProjectRootDirectory(); // Replace with the actual way you get the root path
        $photo = $request->photo;
        $photoName = time() . '.' . $photo->extension();
        $photo->move($root_path . '/' . $path, $photoName);
        $employeeData['photo'] = $path . $photoName;
    }

    Employee::Employeeadd($employeeData);

    return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
