<?php

namespace App\Modules\Inventory\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\FixedHoliday;
use App\Modules\Inventory\Models\Product;
use App\Modules\Inventory\Models\Seller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function product()
    {
        return view('Inventory::products.product.product');
    }

    public function productAdd()
    {
        $data = FixedHoliday::get();
        return view('Inventory::products.product.add-product', compact('data'));
    }

    public function productEdit($id)
    {
        $data = Product::where('id', decrypt($id))->first();

        return view('Inventory::products.product.edit-product', compact('data'));
    }

    public function submitProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'category' => 'required',
            ]
        );
        Product::Productadd($request);

        return redirect()->route('product')->with('Successfully added');
    }

    public function updateProduct(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'category' => 'required',
            ]
        );
        Product::Productupdated($request);

        return redirect()->route('product')->with('Successfully Updated');
    }

    public function getProduct(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Product::orderBy('id', 'desc')->get();

            return DataTables::of($list)
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';



                //         $btn .= '<a href="' . route('product-edit', ['id' => encrypt($list->id)]) . '"
                //         <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                //         <span class="fe fe-edit"> </span>
                //         </button></a>
                // <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteProduct(this.id,event)">
                //             <span class="fe fe-trash-2"> </span>
                //         </button>';

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

    public function deleteProduct(Request $request)
    {
        Product::deleteProduct($request);
        return back()->with('success', 'Successfully deleted');
    }

}
