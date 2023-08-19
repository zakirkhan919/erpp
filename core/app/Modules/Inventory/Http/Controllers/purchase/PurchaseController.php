<?php

namespace App\Modules\Inventory\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Models\Seller;
use App\Modules\Inventory\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    public function purchase()
    {
        return view('Inventory::products.purchase.purchase');
    }

    public function purchaseAdd()
    {
        $products = Product::orderBy('id', 'desc')->select('id', 'name')->get();
        $sellers = Seller::orderBy('id', 'desc')->select('id', 'name')->get();

        return view('Inventory::products.purchase.add-purchase', compact('products', 'sellers'));
    }

    public function purchaseEdit($id)
    {
        $products = Product::orderBy('id', 'desc')->select('id', 'name')->get();
        $sellers = Seller::orderBy('id', 'desc')->select('id', 'name')->get();

        $data = Purchase::where('id', decrypt($id))->first();
        return view('Inventory::products.purchase.edit-purchase', compact('products', 'sellers','data'));
    }

    public function submitPurchase(Request $request)
    {
        $request->validate(
            [
                'product_id' => 'required',
                'seller_id' => 'required',
                'purchase_date' => 'required',
                'quantity' => 'required',
            ]
        );
        Purchase::Purchaseadd($request);


        return redirect()->route('purchase')->with('Successfully added');
    }

    public function updatePurchase(Request $request)
    {

        $request->validate(
            [
                'product_id' => 'required',
                'seller_id' => 'required',
                'purchase_date' => 'required',
                'quantity' => 'required',
            ]
        );
        Purchase::Purchaseupdated($request);

        return redirect()->route('purchase')->with('Successfully Updated');
    }

    public function getPurchase(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Purchase::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';

                    $btn .= '<a href="' . route('purchase-edit', ['id' => encrypt($list->id)]) . '"
                    <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                    <span class="fe fe-edit"> </span>
                    </button></a>
                    <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deletePurchase(this.id,event)">
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

    public function deletePurchase(Request $request)
    {
        Purchase::deletePurchase($request);
        return back()->with('success', 'Successfully deleted');
    }

}
