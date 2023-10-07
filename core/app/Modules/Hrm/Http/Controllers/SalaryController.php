<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Modules\Hrm\Models\Attendance;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\FixedHoliday;
use App\Modules\Hrm\Models\LeaveApplication;
use App\Modules\Hrm\Models\Miscellaneouses;
use App\Modules\Hrm\Models\OccasionHoliday;
use App\Modules\Hrm\Models\Provident_fund;
use App\Modules\Hrm\Models\Roaster;
use App\Modules\Hrm\Models\Salary;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Session;
use Auth;
use Faker\Calculator\Ean;
use Illuminate\Support\Facades\Redirect;

class SalaryController extends Controller
{
    public function salary()
    {
        return view('Hrm::salary.index');
    }

    public function addSalary()
    {
        return view('Hrm::salary.add_salary');
    }

    public function submitSalary(Request $request)
    {
        $dateTime = new DateTime($request->month);
        $numericMonth = $dateTime->format('m');
        $monthWithoutLeadingZero = ltrim($dateTime->format('m'), '0');

        // Get all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $providentFund = Provident_fund::where('employee_id', $employee->id)->first();
            if (!$providentFund) {
                $providentFund = $employee->provident_fund;
            }

            $miscellaneous = Miscellaneouses::where('employee_id', $employee->id)->where('month', $monthWithoutLeadingZero)->where('year', $request->year)->get();
            $roaster = Roaster::where('emp_id', $employee->id)
                ->whereYear('date', $request->year)
                ->whereMonth('date', $numericMonth)
                ->get();

            $result = $this->calculateSalary($employee, $providentFund, $miscellaneous, $roaster, $request->month, $request->year);
            $total = $result['total'];
            $totalRoasterHours = $result['totalRoasterHours'];
            $totalAttendanceHours = $result['totalAttendanceHours'];
            $presentDays = $result['presentDays'];
            $absentDays = $result['absentDays'];
            $net_pay = $result['net_pay'];

            Salary::SalaryAdd($employee, $providentFund, $miscellaneous, $totalRoasterHours, $totalAttendanceHours, $request->month, $request->year, $total, $presentDays, $absentDays, $net_pay);


        }

        return redirect()->route('salary')->with('success', 'Salaries generated successfully.');

    }

    private function calculateSalary($employee, $providentFund, $miscellaneous, $roaster, $month, $year)
    {
        // Get employee details
        $baseSalary = $employee->joining_salary;
        $medicalAllowance = $employee->medical_allowance;
        $houseRent = $employee->house_rent;
        $incentive = $employee->incentive;
        $insurance = $employee->insurance;
        $tax = $employee->tax;
// Calculate provident fund
        $providentFundAmount = $providentFund ? $providentFund->provident_fund : 0;

// Calculate roaster
        $dateTime = new DateTime($month);
        $numericMonth = $dateTime->format('m');
        $totalRoasterMinutes = Roaster::where('emp_id', $employee->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $numericMonth)
            ->selectRaw('SUM(60 * SUBSTRING_INDEX(hours, ":", 1) + SUBSTRING_INDEX(hours, ":", -1)) AS total_minutes')
            ->first()
            ->total_minutes;
        $totalRoasterHours = floor($totalRoasterMinutes / 60);
        $remainingRoasterMinutes = $totalRoasterMinutes % 60;
        $totalRoasterTime = sprintf('%02d:%02d', $totalRoasterHours, $remainingRoasterMinutes);

 //calculate attandance
        $totalAttendanceMinutes = Attendance::where('emp_id', $employee->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $numericMonth)
            ->selectRaw('SUM(60 * SUBSTRING_INDEX(hours, ":", 1) + SUBSTRING_INDEX(hours, ":", -1)) AS total_minutes')
            ->first()
            ->total_minutes;
        $totalAttendanceHours = floor($totalAttendanceMinutes / 60);
        $remaininAttendanceMinutes = $totalAttendanceMinutes % 60;
        $totalAttendanceTime = sprintf('%02d:%02d', $totalAttendanceHours, $remaininAttendanceMinutes);

//calculate present and absent days
        $roasterDayCount = Roaster::where('emp_id', $employee->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $numericMonth)
            ->count();

        // Count the occurrences of weekends in the month
        $fixedHolidays = FixedHoliday::all();
        $holidaysArray = [];
        foreach ($fixedHolidays as $holiday) {
            $day = $holiday->day;
            if (!empty($day)) {
                $holidaysArray[] = $day;
            }
        }
        $startDate = "$year-$numericMonth-01";
        $endDate = "$year-$numericMonth-" . date('t', strtotime($startDate));
        //construct an array of days of a particular month
        $daysInMonth = [];
        $currentDate = strtotime($startDate);
        while ($currentDate <= strtotime($endDate)) {
            $dayName = date('l', $currentDate);
            $daysInMonth[] = $dayName;
            $currentDate = strtotime('+1 day', $currentDate);
        }

        $weekendCount = [];
        $totalWeekends = 0;
        foreach ($holidaysArray as $holiday) {
            $count = array_count_values($daysInMonth)[$holiday] ?? 0;
            $weekendCount[$holiday] = $count;
            $totalWeekends += $count;
        }
        $occasionalHolidays = OccasionHoliday::whereYear('date', $year)->whereMonth('date', $numericMonth)->count();
        $totalHolidaysInMonth = $totalWeekends + $occasionalHolidays;


        //count number of attendaded days
        $attendanceDayCount = Attendance::where('emp_id', $employee->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $numericMonth)
            ->count();

        //count number of leaves
        $leaveApplications = LeaveApplication::where('employee_id', $employee->id)
            ->whereYear('from_date', $year)
            ->whereMonth('from_date', $numericMonth)
            ->get();

        $unpaidLeave = 0;
        $paidLeave = 0;
        foreach ($leaveApplications as $application) {
            if ($application->leave_type == 'Unpaid' || $application->leave_type == 'Other') {
                $unpaidLeave = $unpaidLeave + 1;

            } else {
                $paidLeave = $paidLeave + 1;
            }
        }

        //count present and absent days
        $actualworkingDaysOfAMonth = $roasterDayCount - $totalHolidaysInMonth;
        $presentDays = $attendanceDayCount + $paidLeave;
        $absentDays = $actualworkingDaysOfAMonth - $presentDays;
        if($presentDays > $actualworkingDaysOfAMonth){
            $overtime = $presentDays - $actualworkingDaysOfAMonth;
        }

        // Calculate miscellaneous earnings and deductions
        $miscellaneousEarnings = $miscellaneous->where('type', 'Addition')->sum('amount');
        $miscellaneousDeductions = $miscellaneous->where('type', 'Deduction')->sum('amount');

        // Calculate total
        $total = $baseSalary + $medicalAllowance + $houseRent + $incentive + $insurance - $tax + $miscellaneousEarnings - $miscellaneousDeductions - $providentFundAmount;
        // calculate netPay
        $numberOfDaysInAMonth = date('t', strtotime("$year-$numericMonth-01"));
        $perDaySalary = $total/$numberOfDaysInAMonth;
        $net_pay = $total - ($perDaySalary *$absentDays);

        $data = [
            'total' => $total,
            'totalRoasterHours' => $totalRoasterTime,
            'totalAttendanceHours' => $totalAttendanceTime,
            'presentDays' => $presentDays,
            'absentDays' => $absentDays,
            'net_pay' => $net_pay
        ];
        return $data;
    }


    public function getSalary(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {

            $list = Salary::with('employee')->orderBy('id', 'desc')->get();

            return DataTables::of($list)
            ->addColumn('employee_name', function ($list) {
                return $list->employee->name;
            })
                ->addColumn('action', function ($list) {
                    $access = \App\Modules\User\Models\RolePermission::where("id", \Auth::guard()->user()->role_id)->first();
                    $access = $access ? json_decode($access->permission) : [];
                    $checkAdmin = Auth::guard("web")->user()->type == "admin" || Auth::guard("web")->user()->type == "superadmin" ? true : false;
                    $btn = '';


                    if ($checkAdmin) {
                        $btn .= '<a href="' . route('make_payment', ['id' => encrypt($list->id)]) . '"
                        <button id="pay" type="button" class="btn btn-sm btn-primary">
                        Pay
                        </button></a>
                        <button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSalary(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                        </button>';
                    } else {

                        if (array_search("make-payment/*", $access) > -1) {
                            $btn .= '<a href="' . route('make_payment', ['id' => encrypt($list->id)]) . '"
                            <button id="pay" type="button" class="btn btn-sm btn-primary">
                            Pay
                            </button></a>';
                        }

                        if (array_search("salary-delete", $access) > -1) {
                            $btn .= '<button type="button" class="btn  btn-sm btn-danger"  id="' . encrypt($list->id) . '" onClick="deleteSalary(this.id,event)">
                            <span class="fe fe-trash-2"> </span>
                            </button>';
                        }
                    }

                    return $btn;
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Exception $e) {
            Session::flash('error', CommonFunction::showErrorPublic($e->getMessage()) . '[UC-1001]');
            return Redirect::back();
        }
    }

    public function salaryEdit($id)
    {
        // Your logic for the 'update-Salary/{id}' route
    }

    public function salaryUpdate(Request $request)
    {
        // Your logic for the 'update-Salary' route
    }

    public function salaryDelete(Request $request)
    {
        // Your logic for the 'Salary-delete' route
    }
}
