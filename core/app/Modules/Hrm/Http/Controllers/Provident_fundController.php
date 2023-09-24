<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Provident_fund;
use Illuminate\Http\Request;
use Session;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;
use App\Libraries\CommonFunction;


class Provident_fundController extends Controller
{
    public function provident_fund()
    {
        return view('Hrm::provident_fund.index');
    }

    public function addProvident_fund()
    {
        $employees = Employee::all();
        return view('Hrm::provident_fund.add_provident_fund', compact('employees'));
    }

    public function submitProvident_fund(Request $request)
    {
        $request->validate([
            'employee' => 'required|exists:employees,id',
            // 'previous_provident_fund' => 'required|numeric',
            // 'previous_month' => 'required|integer',
            'provident_fund' => 'required|numeric',
            'remarks' => 'nullable|string|max:255',
            'status' => 'required|in:1,2', // Adjust values as needed
        ]);

        Provident_fund::Provident_fundAdd($request);
        return redirect()->route('provident_fund')->with('success', 'provident fund added successfully.');

    }

    public function getProvident_fund(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Provident_fund::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('provident_fund-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteProvident_fund(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("provident_fund-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('provident_fund-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("provident_fund-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteProvident_fund(this.id,event)">
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

    public function provident_fundEdit($id)
    {
        $data = Provident_fund::where('id', decrypt($id))->first();
        $employees = Employee::all();
        return view('Hrm::provident_fund.edit_provident_fund', compact('data', 'employees'));
    }


    public function provident_fundUpdate(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            // 'previous_provident_fund' => 'nullable|numeric',
            // // Add validation rules for other fields
            // 'previous_month' => 'nullable',
            // Add validation rules for other fields
            'provident_fund' => 'required|numeric',
            'remarks' => 'nullable',
            // Add validation rules for other fields
            'status' => 'required|in:1,2',

        ]);

        Provident_fund::Provident_fundUpdated($request);

        return redirect()->route('provident_fund')->with('Successfully Updated');

    }

    public function provident_fundDelete(Request $request)
    {
        Provident_fund::deleteProvident_fund($request);
        return back()->with('success', 'Successfully deleted');
    }
}
