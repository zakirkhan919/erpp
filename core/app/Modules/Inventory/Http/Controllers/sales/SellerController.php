<?php

namespace App\Modules\Inventory\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Inventory\Models\Seller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class SellerController extends Controller
{
    public function seller()
    {
        return view('Inventory::sales.seller.seller');
    }

    public function sellerAdd()
    {
        return view('Inventory::sales.seller.add-seller');
    }

    public function submitSeller(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:sellers',
                'phone' => 'required|unique:sellers',
                'address' => 'required',
            ]
        );
        Seller::Selleradd($request);

        return redirect()->route('seller')->with('Successfully added');
    }

    public function getSeller(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Seller::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';

                    $btn .= '<a href="' . route('seller-edit', ['id' => encrypt($list->id)]) . '"
                    <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                    <span class="fe fe-edit"> </span>
                    </button></a>
                    <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSeller(this.id,event)">
                        <span class="fe fe-trash-2"> </span>
                    </button>';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('seller-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSeller(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("seller-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('seller-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("seller-delete", $access) > -1) {
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

    public function sellerEdit($id)
    {
        $data = Seller::where('id', decrypt($id))->first();
        return view('Inventory::sales.seller.edit-seller', compact('data'));
    }

    public function updateSeller(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
            ]
        );
        Seller::Sellerupdated($request);

        return redirect()->route('seller')->with('Successfully Updated');
    }


    public function deleteSeller(Request $request)
    {
        Seller::deleteSeller($request);
        return back()->with('success', 'Successfully deleted');
    }
}
