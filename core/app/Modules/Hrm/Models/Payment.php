<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function addPayment($request)
    {

        $payment = Payment::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
            'net_pay' => $request->amount,
            'type' => $request->payment_type,
            'remarks' => $request->remarks,
            'month' => $request->month,
            'year' => $request->year,
            'salary_id' => $request->salary_id,

        ]);

        if ($request->payment_type == 'bank') {
            $employeeBankInfo = EmployeeBankAccountDetail::where('employee_id', $request->employee_id)->first();
            $bankDetailsString = $employeeBankInfo->account_name . ', ' .
                $employeeBankInfo->bank_name . ', ' .
                $employeeBankInfo->branch . ', ' .
                $employeeBankInfo->account_no;

            $payment->update([
                'bank_id' => $employeeBankInfo->id,
                'bank_details' => $bankDetailsString,
            ]);
        }

        $salary = Salary::find($request->salary_id);
        $salary->update([
            'salary_given_date' => now()->toDateString(),
            'payment_status' => 'paid'
        ]);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
