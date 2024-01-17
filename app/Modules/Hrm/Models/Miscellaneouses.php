<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miscellaneouses extends Model
{
    use HasFactory;


    protected $guarded = [];

    public static function MiscellaneousAdd($request)
    {
        Miscellaneouses::create([
            'employee_id' => $request->employee,
            'type' => $request->type,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

    }

    public static function MiscellaneousUpdated($request)
    {
        // Validation passed, update the record
        $miscellaneous = Miscellaneouses::findOrFail($request->id);
        $miscellaneous->employee_id = $request['employee'];
        $miscellaneous->type = $request['type'];
        $miscellaneous->month = $request['month'];
        $miscellaneous->year = $request['year'];
        $miscellaneous->amount = $request['amount'];
        $miscellaneous->comment = $request['comment'];
        $miscellaneous->status = $request['status'];
        // Update other fields if needed
        $miscellaneous->save();
    }

    public static function deleteMiscellaneous($request)
    {

        $id = decrypt($request->id);
        info($id);

        $data = Miscellaneouses::find($id);
        if ($data) {
            $data->delete();
        }
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
