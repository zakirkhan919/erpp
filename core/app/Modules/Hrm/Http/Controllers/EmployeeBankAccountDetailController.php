<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\EmployeeBankAccountDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Session;
use Illuminate\Support\Facades\Redirect;

class EmployeeBankAccountDetailController extends Controller
{


    public function bank_detail(){
        return view('Hrm::bank.index');
    }
    public function addBank_detail(){
        $employees = Employee::all();
        return view('Hrm::bank.add_bank_details', compact('employees'));
    }
    public function submitBank_detail(Request $request){

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:255',
            'pan_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',

        ]);

        EmployeeBankAccountDetail::Bank_detailAdd($request);

        return redirect()->route('bank_detail')->with('success', 'Bank Information added successfully.');



    }

    public function getBank_detail(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = EmployeeBankAccountDetail::with('employee')->orderBy('id', 'desc')->get();

            return DataTables::of($list)
            ->addColumn('employee_name', function ($list) {
                return $list->employee->name;
            })

                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('bank_detail-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteBank_detail(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("edit-bank_detail/*", $access) > -1) {
                            $btn .= '<a href="' . route('bank_detail-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("bank_detail-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteBank_detail(this.id,event)">
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

    public function bank_detailEdit($id){
        $data = EmployeeBankAccountDetail::where('id', decrypt($id))->first();
        $employees = Employee::all();
        return view('Hrm::bank.edit_bank', compact('data', 'employees'));

    }

    public function bank_detailUpdate(Request $request){
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:255',
            'pan_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',

        ]);

        EmployeeBankAccountDetail::Bank_detailUpdate($request);
        return redirect()->route('bank_detail')->with('success', 'Bank Information updated successfully.');

    }

    public function bank_detailDelete(Request $request){
        EmployeeBankAccountDetail::deleteBank_detail($request);
        return redirect()->route('bank_detail')->with('success', 'Bank Information deleted successfully.');
    }

}
