<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Libraries\CommonFunction;
use App\Models\District;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;

class InviteMember extends Controller
{
    public function InviteMember()
    {
        $members = Member::all();
        $districts = District::all();
        return view('Finance::admin.invite_member.index', compact('members', 'districts'));
    }

    public function InviteMemberGet(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Member::where('type_id', 4)->orderBy('id', 'desc')->get();
            return DataTables::of($list)
            ->editColumn('type', function ($list) {
                if ($list->type_id) {
                    if ($list->type->color == 'bg-primary') {
                        return '<p class="bg-primary text-white text-center">' . $list->type->name ?? "" . '</p';
                    } else if ($list->type->color == 'bg-success') {
                        return '<p class="bg-success text-white text-center">' . $list->type->name ?? "" . '</p';
                    } else if ($list->type->color == 'bg-secondary') {
                        return '<p class="bg-secondary text-white text-center">' . $list->type->name ?? "" . '</p';
                    } else {
                        return '<p class="bg-info text-white text-center">' . $list->type->name ?? "" . '</p';
                    }
                } else {
                    return "";
                }
            })
            ->editColumn('district', function ($list) {
                if ($list->district_id) {
                    return $list->district->bn_name ?? "";
                } else {
                    return "";
                }
            })
            ->editColumn('thana', function ($list) {
                if ($list->thana_id) {
                    return $list->thana->bn_name ?? "";
                } else {
                    return "";
                }
            })
            ->editColumn('union', function ($list) {
                if ($list->union_id) {
                    return $list->union->bn_name ?? "";
                } else {
                    return "";
                }
            })
            // ->editColumn('status', function ($list) {
            //     return CommonFunction::getStatus($list->status);
            // })
            ->addColumn('action', function ($list) {
                $access = \App\Modules\User\Models\RolePermission::where("id",\Auth::guard()->user()->role_id)->first();
                $access = $access ? json_decode($access->permission) : [];
                $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                $btn = '';



                if($checkAdmin){
                    $btn .= '<button type="button" class="btn  btn-sm btn-info"   id="' . encrypt($list->id) . '" onClick="memberDetails(this.id,event)">
                    <span class="fe fe-eye"> </span>
                    </button> <a href="' . route('edit.member', ['id' => encrypt($list->id)]) . '"
                    <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                    <span class="fe fe-edit"> </span>
                    </button></a>
                    <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteMember(this.id,event)">
                        <span class="fe fe-trash-2"> </span>
                    </button>';
                }else{

                    if(array_search("member/view",$access) > -1){
                        $btn .= '<button type="button" class="btn  btn-sm btn-info"  id="' . encrypt($list->id) . '" onClick="memberDetails(this.id,event)">
                        <span class="fe fe-eye"> </span>
                        </button>';
                    }

                    if(array_search("member/edit/*",$access) > -1){
                        $btn .= '<a href="' . route('edit.member', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>';
                    }

                    if(array_search("member/delete",$access) > -1){
                        $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteMember(this.id,event)">
                        <span class="fe fe-trash-2"> </span>
                        </button>';
                    }
                }

                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['type', 'district', 'thana', 'union', 'action'])
            ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function InviteSubmit(Request $request)
    {
        $member = Member::findOrFail($request->member_id);
        $member->committe_type = null;
        $member->type_id = 4;
        $member->save();

        return redirect()->back();
    }
}
