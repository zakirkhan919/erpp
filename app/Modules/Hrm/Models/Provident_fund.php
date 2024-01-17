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

    public static function Provident_fundUpdated($request){


        // Update provident fund record in the database
        $providentFund = Provident_fund::find($request->id); // Assuming 'id' is the primary key column

        $providentFund->employee_id = $request['employee'];
        $providentFund->previous_provident_fund = $request['previous_provident_fund'];
        $providentFund->previous_month = $request['previous_month'];
        $providentFund->provident_fund = $request['provident_fund'];
        $providentFund->remarks = $request['remarks'];
        $providentFund->status = $request['status'];
        // Set other fields as needed

        $providentFund->save();
    }

    public static function deleteProvident_fund($request)
    {

        $id = decrypt($request->id);

        $data = Provident_fund::find($id);
        info( $data);

        if ($data) {
            $data->delete();
        }
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
