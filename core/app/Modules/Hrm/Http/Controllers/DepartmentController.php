<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Department;
use Illuminate\Http\Request;
use App\Libraries\CommonFunction;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Department()
    {
        return view('Hrm::department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addDepartment()
    {
        return view('Hrm::department.add_department');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SubmitDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|max:255',
        ]);

        Department::Departmentadd($request);

        return redirect()->route('departments.index')->with('Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Hrm\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function getDepartment(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Department::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('department-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSeller(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("department-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('department-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("department-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteDepartment(this.id,event)">
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
     * @param  \App\Modules\Hrm\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function departmentEdit($id)
    {
        $data = Department::where('id', decrypt($id))->first();
        return view('Hrm::department.edit_department', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modules\Hrm\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function departmentUpdate(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'nullable|max:255',

            ]
        );
        Department::Departmentupdated($request);

        return redirect()->route('department')->with('Successfully Updated');
    }


    public function deleteDepartment(Request $request)
    {
        Department::deleteDepartment($request);
        return back()->with('success', 'Successfully deleted');
    }
}
