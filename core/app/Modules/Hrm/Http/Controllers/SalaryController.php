<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Employee;
use App\Modules\Hrm\Models\Miscellaneouses;
use App\Modules\Hrm\Models\Provident_fund;
use App\Modules\Hrm\Models\Roaster;
use App\Modules\Hrm\Models\Salary;
use DateTime;
use Illuminate\Http\Request;

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
            // Retrieve employee-related data (provident fund, miscellaneous, roaster, etc.)
            $providentFund = Provident_fund::where('employee_id', $employee->id)->first();
            $miscellaneous = Miscellaneouses::where('employee_id', $employee->id)->where('month', $monthWithoutLeadingZero)->where('year' , $request->year)->get();
            // $roaster = Roaster::where('emp_id', $employee->id)->get();



            // Calculate the salary for this employee based on the retrieved data
            $totalSalary = $this->calculateSalary($employee, $providentFund, $miscellaneous, /*$roaster*/ $request->month, $request->year);

            Salary::SalaryAdd($employee, $providentFund, $miscellaneous, /*$roaster*/ $request->month, $request->year, $totalSalary);


        }

        return redirect()->route('salary')->with('success', 'Salaries generated successfully.');

    }

    private function calculateSalary($employee, $providentFund, $miscellaneous, /*$roaster*/ $month, $year)
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


        $dateTime = new DateTime($month);
        $numericMonth = $dateTime->format('m');

        // Calculate roaster
        // $totalWorkingHours = Roaster::where('emp_id', $employee->id)
        //     ->whereYear('date', $year)
        //     ->whereMonth('date', $numericMonth) // Use the numeric month
        //     ->sum('hours');


        // Calculate miscellaneous earnings and deductions
        $miscellaneousEarnings = $miscellaneous->where('type', 'Addition')->sum('amount');
        $miscellaneousDeductions = $miscellaneous->where('type', 'Deduction')->sum('amount');

        // Calculate total salary
        $totalSalary = $baseSalary + $medicalAllowance + $houseRent + $incentive + $insurance - $tax + $miscellaneousEarnings - $miscellaneousDeductions - $providentFundAmount;

        return $totalSalary;
    }


    public function getSalary(Request $request)
    {
        // Your logic for the 'get-Salary' route
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
