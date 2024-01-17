<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Libraries\CommonFunction;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class ComplainController extends Controller
{
    public function Complain()
    {
        return view('Finance::admin.complain.index');
    }

    public function AddComplain()
    {
        return view('Finance::admin.complain.complain_add');
    }

    public function ComplainGet(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Complain::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('member_name', function ($list) {
                    if ($list->member_id) {
                        return $list->member_name->name ?? "";
                    } else {
                        return "";
                    }
                })
                ->editColumn('number', function ($list) {
                    if ($list->number) {
                        return en_to_bn($list->number) ?? "";
                    } else {
                        return "";
                    }
                })
                ->editColumn('date', function ($list) {
                    if ($list->created_at) {
                        return en_to_bn($list->created_at->format('d.m.Y h:i A')) ?? "";
                    } else {
                        return "";
                    }
                })
                ->addColumn('action', function ($list) {


                   $access = \App\Modules\User\Models\RolePermission::where("id",\Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';



                    if($checkAdmin){
                        $btn .= '<a href="' . route('edit.complain', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>';
                    }else{
                        if(array_search("complain/edit/*",$access) > -1){
                            $btn .= '<a href="' . route('edit.complain', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }
                    }
                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['member_name', 'number', 'date', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function EditComplain($id)
    {
        $id = decrypt($id);
        return view('Finance::admin.complain.complain_edit', compact('id'));
    }
}
