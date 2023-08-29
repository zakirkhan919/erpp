<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Miscellaneouses;
use Illuminate\Http\Request;
use Auth;
use Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Libraries\CommonFunction;


class MiscellaneousController extends Controller
{
    public function miscellaneous()
    {
        return view('Hrm::miscellaneous.index');
    }

    public function addMiscellaneous()
    {
        $employees = Employee::all();
        $availableYears = range(date("Y"), 1990); // Change the range as needed
        $months = range(1, 12);
        return view('Hrm::miscellaneous.add_miscellaneous', compact('employees', 'availableYears', 'months'));



    }

    public function submitMiscellaneous(Request $request)
    {
        $request->validate([
            'employee' => 'required|exists:employees,id',
            'type' => 'required|in:Addition,Deduction', // Check if type is either "Addition" or "Deduction"
            'month' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'comment' => 'nullable|string|max:255',
            'status' => 'required|in:1,2', // Adjust values as needed

        ]);


        Miscellaneouses::MiscellaneousAdd($request);

        return redirect()->route('miscellaneous')->with('success', 'Miscellaneous added successfully.');



    }

    public function getMiscellaneous(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Miscellaneouses::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('miscellaneous-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteMiscellaneous(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("miscellaneous-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('miscellaneous-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("miscellaneous-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteMiscellaneous(this.id,event)">
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

    public function miscellaneousEdit($id)
    {
        $data = Miscellaneouses::where('id', decrypt($id))->first();
        $employees = Employee::all();
        return view('Hrm::miscellaneous.edit_miscellaneous', compact('data', 'employees'));    
    }

    public function miscellaneousUpdate(Request $request)
    {
        // Your logic for the 'update-miscellaneous' route
    }

    public function miscellaneousDelete(Request $request)
    {
        // Your logic for the 'miscellaneous-delete' route
    }
}
