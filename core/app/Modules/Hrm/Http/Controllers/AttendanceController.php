<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Attendance;
use App\Modules\Hrm\Models\Employee;
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
        
    }

    public function ViewAttendance()
    {

    }

}
