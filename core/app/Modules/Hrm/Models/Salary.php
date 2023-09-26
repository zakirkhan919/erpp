<?php

namespace App\Modules\Hrm\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function SalaryAdd($employee, $providentFund, $miscellaneous, $totalRoasterHours, $totalAttendanceHours, $month, $year, $totalSalary,$presentDays, $absentDays, $net_pay )
    {

        $dateTime = new DateTime($month);
        $numericMonth = $dateTime->format('m');
        $miscellaneousAdditionCost = 0;
        $miscellaneousDeductionCost = 0;
        foreach($miscellaneous as $item) {
            $item->type == 'Deduction' ?
            $miscellaneousDeductionCost = $miscellaneousDeductionCost + $item->amount :
            $miscellaneousAdditionCost = $miscellaneousAdditionCost + $item->amount;

        }
        Salary::create([
            'employee_id' => $employee->id,
            'regular_salary' => $employee->joining_salary,
            'month' => $numericMonth,
            'year' => $year,
            //salary_given_date
            'medical_allowance' => $employee->medical_allowance,
            'provident_found' => $providentFund->provident_fund,
            'house_rent' => $employee->house_rent,
            'incentive' => $employee->incentive,
            'insurance' => $employee->insurance,
            'tax' => $employee->tax,
            'total' => $totalSalary,
            'roaster_hours' => $totalRoasterHours,
            'working_hours' => $totalAttendanceHours,
            'present' => $presentDays,
            'absent' => $absentDays,
            'net_pay' => $net_pay,
            'miscellaneous_addition' => $miscellaneousAdditionCost,
            'miscellaneous_deduction' => $miscellaneousDeductionCost,
            'payment_status' => 'unpaid'

        ]);
    }

}
