<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provident_fund extends Model
{
    use HasFactory;
    protected $guarded = [];


    public static function Provident_fundAdd($request)
    {
        Provident_fund::create([
            'employee_id' => $request->employee,
            'previous_provident_fund' => $request->previous_provident_fund,
            'previous_month' => $request->previous_month,
            'provident_fund' => $request->provident_fund,
            'remarks' => $request->remarks,
            'status' => $request->status,
        ]);

    }
}
