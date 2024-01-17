<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Models\CreditAmount;
use App\Models\Member;
use App\Models\SpendAmount;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function Financial()
    {

        return view('Finance::admin.report.financial');
    }

    public function FromSubmit(Request $request)
    {
        if($request->transection == 1)
        {
            $data = CreditAmount::where('date', '>=', $request->from_date)->where('date', '<=', $request->to_date)->get();
        }else{
            $data = SpendAmount::where('date', '>=', $request->from_date)->where('date', '<=', $request->to_date)->get();
        }

        $dataView = view('Finance::admin.report.ajax_view', compact('data'))->render();

        return response()->json(array('success' => true, 'html'=>$dataView));
    }

    public function MemberReport()
    {
        return view('Finance::admin.report.member');
    }

    public function FromMemberSubmit(Request $request)
    {

        $data = Member::where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date)->get();


        $dataView = view('Finance::admin.report.ajax_view_member', compact('data'))->render();

        return response()->json(array('success' => true, 'html'=>$dataView));
    }
}
