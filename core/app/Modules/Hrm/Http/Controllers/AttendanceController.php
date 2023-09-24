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
                            $leave->status = 'Approved';
                            $leave->save();
                        }else {
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

    }

}
