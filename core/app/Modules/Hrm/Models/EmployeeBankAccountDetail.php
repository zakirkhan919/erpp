<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankAccountDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function Bank_detailAdd($request)
    {
        EmployeeBankAccountDetail::create([
            'employee_id' => $request->employee_id,
            'account_name' => $request->account_name,
            'account_no' => $request->account_number,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'ifsc_code' => $request->ifsc_code,
            'pan_no' => $request->pan_number,
        ]);

    }

    public static function deleteBank_detail($request){

        $id = decrypt($request->id);
        $data = EmployeeBankAccountDetail::find($id);
        if($data){
            $data->delete();
        }

    }

    public static function Bank_detailUpdate($request){
        $bank_detail = EmployeeBankAccountDetail::findOrFail($request->id);

        $bank_detail->employee_id = $request['employee_id'];
        $bank_detail->account_name = $request['account_name'];
        $bank_detail->account_no = $request['account_number'];
        $bank_detail->bank_name = $request['bank_name'];
        $bank_detail->branch = $request['branch'];
        $bank_detail->ifsc_code = $request['ifsc_code'];
        $bank_detail->pan_no = $request['pan_number'];

        $bank_detail->save();

    }

}
