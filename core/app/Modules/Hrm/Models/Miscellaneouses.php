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

    public static function Departmentupdated($request)
    {
        $data = Department::find($request->id);

        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();
    }

    public static function deleteDepartment($request)
    {

        $id = decrypt($request->id);
        info( $id);

        $data = Department::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
