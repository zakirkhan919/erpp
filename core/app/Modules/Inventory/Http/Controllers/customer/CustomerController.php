<?php

namespace App\Modules\Inventory\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Inventory\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;

use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function customer()
    {
        return view('Inventory::sales.customer.customer');
    }

    public function customerAdd()
    {
        return view('Inventory::sales.customer.add-customer');
    }

    public function submitCustomer(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:customers',
                'phone' => 'required|unique:customers',
                'address' => 'required',
            ]
        );
        Customer::Customeradd($request);

        return redirect()->route('customer')->with('Successfully added');
    }

    public function getCustomer(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Customer::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';

                    $btn .= '<a href="' . route('customer-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteCustomer(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('customer-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteCustomer(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("customer-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('customer-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("customer-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteCustomer(this.id,event)">
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

    public function customerEdit($id)
    {
        $data = Customer::where('id', decrypt($id))->first();
        return view('Inventory::sales.customer.edit-customer', compact('data'));
    }

    public function updateCustomer(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]
        );
        Customer::Customerupdated($request);

        return redirect()->route('customer')->with('Successfully Updated');
    }


    public function deleteCustomer(Request $request)
    {
        Customer::deleteCustomer($request);
        return back()->with('success', 'Successfully deleted');
    }
}
