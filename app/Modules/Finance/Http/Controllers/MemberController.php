<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Imports\MemberImport;
use App\Libraries\CommonFunction;
use App\Models\District;
use App\Models\Member;
use App\Models\PostOffice;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Auth;

use DB;
use Excel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::all();
        return view('Finance::admin.member.index', compact('districts'));
    }

    // member show ajax
    public function MemberGet(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Member::query()->orderBy('id', 'DESC');
            return DataTables::of($list)
                // ->editColumn('image', function ($list) {
                //     if ($list->image) {
                //         $url = asset($list->image);
                //         return '<img width="50" height="50" class="rounded-circle" src="' . $url . '"
                //         alt="Member Image">';
                //     } else {
                //         $url = asset("assets/admin/images/dami.png");
                //         return '<img width="50" height="50" src="' . $url . '"
                //         alt="Member Image">';
                //     }
                // })
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Finance::admin.member.add_member');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        return view('Finance::admin.member.edit_member', compact('id'));
    }

    // delete mamber
    public function MemberDelete(Request $request)
    {

        Member::deleteMemberData($request);
        return back()->with('success', 'সফলভাবে অপসারণ করা হয়েছে');
    }

    public function MemberView(Request $request)
    {

        $data = Member::where('id', decrypt($request->id))->first();
        $dataView = view('Finance::admin.member.member_view', compact('data'))->render();
        return response()->json(array('success' => true, 'html'=>$dataView));
    }

    public function ExcelImport()
    {
        return view('Finance::admin.member.member_import');
    }

    public function SubmitExcelImport(Request $request)
    {
        set_time_limit(0);
        $path = $request->file('exfile')->getRealPath();


     $data = Excel::import(new MemberImport, $path);
     dd($data);
    }

    public function getThana(Request $request)
    {
        $thana = Upazila::where('district_id', $request->district_id)->get();
        if (count($thana) > 0) {
            return response()->json($thana);
        }
    }

    public function getpostoffice(Request $request)
    {
        $postoffice = PostOffice::where('upazila_id', $request->thana_id)->get();
        $unions = Union::where('upazilla_id', $request->thana_id)->get();
        if (count($postoffice) > 0) {
            return response()->json(["postoffice" => $postoffice, "union" => $unions]);
        }
    }
    public function getvillage(Request $request)
    {
        $village = Member::where('postOffice', $request->post_id)->groupBy('village')->get();
        if (count($village) > 0) {
            return response()->json($village);
        }
    }

    public function formSubmit(Request $request)
    {
        // dd($request->all());
        $query = DB::table('members as m');

        if($request->district){
            $query->where('district_id', $request->district);
        }
        if($request->thana){
            $query->where('thana_id', $request->thana);
        }
        if($request->postoffice){
            $query->where('postOffice', $request->postoffice);
        }
        if($request->village){
            $query->where('village', $request->village);
        }
        if($request->union_id){
            $query->where('union_id', $request->union_id);
        }
        $data = $query->get();
        $template = view('Finance::admin.member.search_data', compact('data'))->render();
        return response()->json($template);
    }
    public function searchSubmit(Request $request)
    {
        if (Request::isMethod('post')){
            $data = $request->all();
            return view('Finance::admin.member.search-data', compact('data'));
        }else{
            return redirect()->route('members.index');
        }

    }

    public function SearchGet(Request $request)
    {
        // dd($request->all());
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = Member::where('district_id', $request->district)
            ->where('thana_id', $request->thana)
            ->where('postOffice', $request->postoffice)
            ->where('village', $request->village)
            ->get();
            return DataTables::of($list)
                // ->editColumn('image', function ($list) {
                //     if ($list->image) {
                //         $url = asset($list->image);
                //         return '<img width="50" height="50" class="rounded-circle" src="' . $url . '"
                //         alt="Member Image">';
                //     } else {
                //         $url = asset("assets/admin/images/dami.png");
                //         return '<img width="50" height="50" src="' . $url . '"
                //         alt="Member Image">';
                //     }
                // })
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

}
