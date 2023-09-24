<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\ImportRoaster;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Roaster;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon as SupportCarbon;

class RoasterController extends Controller
{
    public function index()
    {
        return view('Hrm::roaster.index');
    }

    public function getRoaster(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Roaster::orderBy('id', 'desc')->with('employee')->get();

            return DataTables::of($list)
                ->editColumn('employee_name', function ($list) {
                    return $list->employee->name;
                })
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('designation-edit', ['id' => encrypt($list->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteDesignation(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("designation-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('designation-edit', ['id' => encrypt($list->id)]) . '"
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                            <span class="fe fe-edit"> </span>
                            </button></a>';
                        }

                        if (array_search("designation-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteDesignation(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                            </button>';
                        }
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['employee_name','action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function addRoaster()
    {
        $employes = Employee::select('id', 'name')->get();
        return view('Hrm::roaster.add_roaster', compact('employes'));
    }

    public function submitRoaster(Request $request)
    {
        try {
            $this->validate($request, [
                'employee_id' => 'required',
            ]);
            $employee = Employee::where('id', $request->employee_id)->first();
            // $date_check = Roaster::where('employee_id', $request->employee_id)->first();
            // dd($employee);
            $period = CarbonPeriod::create($request->from_date, $request->to_date);

            // Iterate over the period
            foreach ($period as $date) {
                $roaster_check = Roaster::where('emp_id', $request->employee_id)->whereDate('date', $date->format('Y-m-d'))->first();
                if ($roaster_check) {
                    $roaster = Roaster::find($roaster_check->id);
                } else {
                    $roaster = new Roaster();
                }
                $roaster->emp_id = $employee->id;
                $roaster->employee_id = $request->employee_id;
                $roaster->date = $date->format('Y-m-d');
                $roaster->start_time = $request->start_time;
                $roaster->end_time = $request->end_time;
                $start = Carbon::parse($request->start_time);
                $end = Carbon::parse($request->end_time);
                $hours = $end->diffInHours($start);
                $minutes_check = $end->diffInMinutes($start);
                $one = $hours * 60;
                $minutes = $minutes_check - $one;
                $roaster->hours = sprintf("%02d", $hours) . ':' . sprintf("%02d", $minutes);
                $roaster->shift = $request->shift;
                $roaster->status = $request->status;
                $roaster->save();
            }
            return redirect()->back()->with('success', 'Successfully added roaster this employee');
            // return $this->successResponse($roaster, 'Roaster Created', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function addCsv()
    {
        return view('Hrm::roaster.add_csv');
    }

    public function submitCsv(Request $request)
    {
        // dd($request->all());
        Excel::import(new ImportRoaster, $request->file('csv_file'));
        return redirect()->route('roaster');
    }


    // roaster swap 
    public function roasterSwap()
    {
        $roasterSwap = Roaster::orderBy('id', 'desc')->with('employee')->get();
        return view('Hrm::roaster.roaster_swap', compact('roasterSwap'));
    }

    public function SwapSubmt(Request $request)
    {
        try {
            $first_roaster = $request->d[0];
            $second_roaster = $request->d[1];
            $roaster_check = Roaster::find($first_roaster);
            $roaster_check1 = Roaster::find($second_roaster);
            if($roaster_check->start_time != $roaster_check1->start_time || $roaster_check->end_time != $roaster_check1->end_time){
                return $this->errorResponse('Roaster cannot swap to due to invalid shift hour',[], Response::HTTP_OK);
            }
            else{
                $temp = $roaster_check->date;
                $roaster_check->date = $roaster_check1->date;
                $roaster_check->save();
                $roaster_check1->date = $temp;
                $roaster_check1->save();
            }
            return $this->successResponse([], 'Roaster has been swaped', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    protected $data = '';
    protected $employes = '';

    
    public function RoasterReport()
    {
        $employes = Employee::select('name', 'id')->get();
        $data = Roaster::whereDate('date', Carbon::now())->get();
        return view('Hrm::roaster.roaster_report', ['data' => $data, 'employes' => $employes]);
    }

    public function RoasterReportSearch(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        if ($request->employee_id == "all") {
            $data = Roaster::where('date', '>=', $from_date)->where('date', '<=', $to_date)->orderBy('date', 'desc')->with('employee')->get();
        } else {
            $data = Roaster::where('date', '>=', $from_date)->where('date', '<=', $to_date)->where('employee_id', $request->employee_id)->with('employee')->get();
        }
        $employes = Employee::select('name', 'id')->get();
        $table_view = view('Hrm::roaster.report_table', ['data' => $data, 'employes' => $employes])->render();
        return response()->json($table_view);
    }
}
