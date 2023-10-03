<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\EmployeeBankAccountDetail;
use App\Modules\Hrm\Models\Payment;
use App\Modules\Hrm\Models\Salary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('Hrm::payment.index');
    }

    public function addPayment()
    {
        $employees = Employee::all();
        return view('Hrm::payment.add_payment', compact('employees'));
    }

    public function submitPayment(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required',
            'payment_type' => 'required|in:cash,bank',
            'remarks' =>'required|string|max:255',
            'month' => 'required',
            'year' => 'required'
        ]);

        Payment::addPayment($request);
        return redirect()->route('salary')->with('Successfully added');

    }

    public function getPayment(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Payment::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deletePayment(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("payment-delete/*", $access) > -1) {
                            $btn .= '<a href="' . route('payment-delete', ['id' => encrypt($list->id)]) . '"
                            <button id="pay" type="button" class="btn btn-sm btn-primary">
                            Pay
                            </button></a>';
                        }

                        if (array_search("payment-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deletePayment(this.id,event)">
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

    public function paymentEdit($id)
    {
        // Your logic for the 'update-payment/{id}' route
    }

    public function paymentUpdate(Request $request)
    {
        // Your logic for the 'update-payment' route
    }

    public function paymentDelete(Request $request)
    {
        // Your logic for the 'payment-delete' route
    }

    public function makePayment ($id){
        $salary = Salary::where('id', decrypt($id))->first();
        $employee = Employee::where('id', $salary->employee_id)->first();
        $bank_detail = EmployeeBankAccountDetail::where('employee_id', $salary->employee_id)->first();
        return view('Hrm::payment.make_payment', compact('salary','employee', 'bank_detail'));
    }


}
