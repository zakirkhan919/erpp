<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Attendance;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\LeaveApplication;
use App\Modules\Hrm\Models\Roaster;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Auth;

use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function Attendance()
    {
        $employes = Employee::select('id', 'name')->get();
        $data = [];
        return view('Hrm::attendance.attendance', ['employes' => $employes, 'data' => $data]);
    }

    public function employeeList(Request $request)
    {
        $roasters = Roaster::whereDate('date', $request->date)->where(function ($query) use ($request) {
            if ($request->employee_id != 'all') {
                $query->where('emp_id', $request->employee_id);
            }
        })->with('employee', 'attendance')->get();
        // dd($roasters);
        $table_view = view('Hrm::attendance.attendence_table', ['data' => $roasters])->render();
        return response()->json($table_view);
    }

    public function SubmitAttendance(Request $request)
    {
        // dd($request->all());
        if ($request->attendance && is_array($request->attendance)) {
            foreach ($request->attendance as $i => $attendance) {
                // dd($i);
                $attendance_check = Attendance::where('roaster_id', $request->roaster_id[$i])->first();
                if ($attendance_check) {
                    $attendance_check->start_time = $request->start_time[$i];
                    $attendance_check->end_time = $request->end_time[$i];
                    $attendance_check->updated_at = Carbon::now();
                    $attendance_check->save();
                } else {
                    $roaster = Roaster::where('id', $request->roaster_id[$i])->first();

                    if ($request->leave_type[$i]) {
                        $leave = new LeaveApplication();
                        $leave->employee_id = $roaster->emp_id;
                        $leave->user_id = auth()->user()->id;
                        $leave->from_date = $request->date[$i];
                        $leave->to_date = $request->date[$i];
                        $leave->leave_type = $request->leave_type[$i];
                        $leave->reason = $request->reason[$i];
                        $leave->total_day = 1;
                        $leave->status = 'Approved';
                        $leave->save();
                    } else {
                        $data = [];
                        $data['roaster_id'] = $request->roaster_id[$i];
                        $data['start_time'] = $request->start_time[$i];
                        $data['end_time'] = $request->end_time[$i];
                        $data['emp_id'] = $roaster->emp_id;
                        $data['date'] = $roaster->date;
                        $data['employee_id'] = $roaster->employee_id;
                        $data['status'] = 1;
                        $data['created_at'] = Carbon::now();
                        Attendance::insert($data);
                    }
                }
            }
        }

        return redirect()->back();
    }

    public function ViewAttendance()
    {
        return view('Hrm::attendance.view_attendance');
    }

    public function GetAttendance(Request $request)
    {
        try {
            $employees = Employee::orderby('id', 'desc')->with('department', 'designation', 'attendances')->get();
            foreach ($employees as $employee) {
                $employee->maternity = LeaveApplication::whereMonth('from_date', date('m'))
                    ->whereYear('from_date', date('Y'))->where('leave_type', 'Maternity')->where('status', 'Approve')->where('employee_id', $employee->id)->sum('total_day');
                $employee->sick = LeaveApplication::whereMonth('from_date', date('m'))
                    ->whereYear('from_date', date('Y'))->where('leave_type', 'Sick')->where('status', 'Approve')->where('employee_id', $employee->id)->sum('total_day');
                $employee->casual = LeaveApplication::whereMonth('from_date', date('m'))
                    ->whereYear('from_date', date('Y'))->where('leave_type', 'Casual')->where('status', 'Approve')->where('employee_id', $employee->id)->sum('total_day');
                $employee->others = LeaveApplication::whereMonth('from_date', date('m'))
                    ->whereYear('from_date', date('Y'))->where('leave_type', 'Other')->where('status', 'Approve')->where('employee_id', $employee->id)->sum('total_day');
                $employee->unpaid = LeaveApplication::whereMonth('from_date', date('m'))
                    ->whereYear('from_date', date('Y'))->where('leave_type', 'Unpaid')->where('status', 'Approve')->where('employee_id', $employee->id)->sum('total_day');
                $employee->total = $employee->maternity + $employee->sick + $employee->others + $employee->unpaid + $employee->casual;
            }
            // dd($employees);
            return DataTables::of($employees)
                ->editColumn('designation', function ($employees) {
                    return '<div>Department: '.$employees->department->name.'</div><div>Designation: '.$employees->designation->name.'</div>';
                })
                ->editColumn('leaves', function ($employees) {
                    return '<div>Sick:'.$employees->sick.'</div><div>Casual: '.$employees->casual.'</div><div>Others: '.$employees->others.'</div><div>Unpaid: '.$employees->unpaid.'</div><div>Total: '.$employees->total.'</div>';
                })
                ->addColumn('action', function ($employees) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('designation-edit', ['id' => encrypt($employees->id)]) . '"
                        <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                        <span class="fe fe-edit"> </span>
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($employees->id) . '" onClick="deleteDesignation(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("designation-edit/*", $access) > -1) {
                            $btn .= '<a href="' . route('designation-edit', ['id' => encrypt($employees->id)]) . '"
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
                ->rawColumns(['designation','leaves','action'])
                ->make(true);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
