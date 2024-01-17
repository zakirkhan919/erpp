<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Http\Livewire\Transection\SpendForm;
use App\Libraries\CommonFunction;
use App\Models\CreditAmount;
use Illuminate\Http\Request;
use App\Models\SpendAmount;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class TransectionController extends Controller
{
    public function CreditTransection()
    {
        return view('Finance::admin.transection.earn');
    }

    // credit Amount show ajax
    public function CreditAmountGet(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = CreditAmount::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {

                    $access = \App\Modules\User\Models\RolePermission::where("id",\Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';



                    if($checkAdmin){
                        $btn .= '<a href="' . route('edit.credit.transection', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteCreditAmount(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    }else{
                        if(array_search("member/edit/*",$access) > -1){
                            $btn .= '<a href="' . route('edit.credit.transection', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if(array_search("member/delete",$access) > -1){
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteCreditAmount(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                        }
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }


    // credit transection add view form
    public function AddCreditTransection()
    {
        return view('Finance::admin.transection.add_earn');
    }

    // credit transection edit view form
    public function EditCreditTransection($id)
    {
        $id = decrypt($id);
        return view('Finance::admin.transection.edit_earn', compact('id'));
    }

    // add and edit on livewire



    // delete mamber
    public function CreditAmountDelete(Request $request)
    {
        CreditAmount::deleteAmountData($request);
        return back()->with('success', 'সফলভাবে অপসারণ করা হয়েছে');
    }


    // spend transection
    public function SpendTransection()
    {
        return view('Finance::admin.transection.spend');
    }

    // credit Amount show ajax
    public function SpendAmountGet(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = SpendAmount::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->addColumn('action', function ($list) {


                    $access = \App\Modules\User\Models\RolePermission::where("id",\Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';



                    if($checkAdmin){
                        $btn .= '<a href="' . route('edit.spend.transection', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSpendAmount(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    }else{
                        if(array_search("member/edit/*",$access) > -1){
                            $btn .= '<a href="' . route('edit.spend.transection', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if(array_search("member/delete",$access) > -1){
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSpendAmount(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                        }
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }


    // credit transection add view form
    public function AddSpendTransection()
    {
        return view('Finance::admin.transection.add_spend');
    }

    // credit transection edit view form
    public function EditSpendTransection($id)
    {
        $id = decrypt($id);
        return view('Finance::admin.transection.edit_spend', compact('id'));
    }

    // add and edit on livewire



    // delete mamber
    public function SpendAmountDelete(Request $request)
    {
        SpendAmount::deleteAmountData($request);
        return back()->with('success', 'সফলভাবে অপসারণ করা হয়েছে');
    }
}
