<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Department;
use App\Modules\Hrm\Models\Designation;
use App\Modules\Hrm\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee()
    {
        return view('Hrm::employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEmployee()
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


    public function submitEmployee(Request $request)
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

        return redirect()->route('employee')->with('success', 'Employee added successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function getEmployee(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Employee::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('employee-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteEmployee(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("employee-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('employee-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("employee-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteEmployee(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                            </button>';
                        }
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function employeeEdit($id)
    {
        $data = Employee::where('id', decrypt($id))->first();
        $departments = Department::all();
        $designations = Designation::all();

        return view('Hrm::employee.edit_employee', compact('data', 'departments', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Hrm\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fathers_name' => 'required|string|max:255',
            'mothers_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:male,female,other',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'joining_date' => 'required|date',
            'joining_salary' => 'required|numeric',
            'medical_allowance' => 'nullable|numeric',
            'provident_fund' => 'nullable|numeric',
            'house_rent' => 'nullable|numeric',
            'incentive' => 'nullable|numeric',
            'insurance' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $this->processPhoto($request->photo);
            $validatedData['photo'] = $path;
        }
        Employee::Employeeupdated($request->id, $validatedData);

        return redirect()->route('employee')->with('Successfully Updated');
    }


    private function processPhoto($photo)
{
    $path = 'assets/uploads/employees/' . date("Y") . "/" . date("m") . "/";
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
        $new_file = fopen($path . '/index.html', 'w') or die('Cannot create file: [UC-1001]');
        fclose($new_file);
    }

    $root_path = CommonFunction::getProjectRootDirectory(); // Replace with the actual way you get the root path
    $photoName = time() . '.' . $photo->extension();
    $photo->move($root_path . '/' . $path, $photoName);

    return $path . $photoName;
}

    public function employeeDelete(Request $request)
    {
        Employee::deleteEmployee($request);
        return back()->with('success', 'Successfully deleted');
    }
}
