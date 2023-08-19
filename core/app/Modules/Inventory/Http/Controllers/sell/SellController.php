<?php

namespace App\Modules\Inventory\Http\Controllers\sell;

use App\Http\Controllers\Controller;
use App\Modules\Inventory\Models\Customer;
use App\Modules\Inventory\Models\Seller;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Models\Sell;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class SellController extends Controller
{
    public function sell()
    {
        return view('Inventory::sales.sell.sell');
    }

    public function sellAdd()
    {
        $sellers = Seller::orderBy('id', 'desc')->select('id', 'name')->get();
        $customers = Customer::orderBy('id', 'desc')->select('id', 'name')->get();
        $products = Product::orderBy('id', 'desc')->select('id', 'name')->get();

        return view('Inventory::sales.sell.add-sell', compact('sellers', 'customers', 'products'));
    }

    public function sellEdit($id)
    {
        $sellers = Seller::orderBy('id', 'desc')->select('id', 'name')->get();
        $customers = Customer::orderBy('id', 'desc')->select('id', 'name')->get();
        $products = Product::orderBy('id', 'desc')->select('id', 'name')->get();

        $data = Sell::where('id', decrypt($id))->first();
        return view('Inventory::products.purchase.edit-purchase', compact('products', 'sellers','customers','data'));
    }

    public function submitsell(Request $request)
    {

        $request->validate(
            [
                'custormer_id' => 'required|exists:customers,id',
                'seller_id' => 'required|exists:sellers,id',
                'product_id' => 'required|exists:products,id',
                'selling_date' => 'required',
                'selling_quantity' => 'required',
            ]
        );
        Sell::Selladd($request);

        return redirect()->route('sell')->with('Successfully added');
    }
    public function updateSell(Request $request)
    {

        $request->validate(
            [
                'custormer_id' => 'required|exists:customers,id',
                'seller_id' => 'required|exists:sellers,id',
                'product_id' => 'required|exists:products,id',
                'selling_date' => 'required',
                'selling_quantity' => 'required',
            ]
        );
        Sell::Sellupdated($request);

        return redirect()->route('sell')->with('Successfully Updated');
    }

    public function getSell(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Sell::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';

                    $btn .= '<a href="' . route('sell-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSell(this.id,event)">
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

    public function deleteSell(Request $request)
    {
        Sell::deleteSell($request);
        return back()->with('success', 'Successfully deleted');
    }
}
