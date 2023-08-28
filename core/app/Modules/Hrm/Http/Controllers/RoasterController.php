<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Roaster;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class RoasterController extends Controller
{
    public function index()
    {
        return view('Hrm::roaster.index');
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
                $roaster_check = Roaster::where('emp_id',$request->employee_id)->whereDate('date',$date->format('Y-m-d'))->first();
                if($roaster_check){
                    $roaster = Roaster::find($roaster_check->id);
                }
                else{
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
}
