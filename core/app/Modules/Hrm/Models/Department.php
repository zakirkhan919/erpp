<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function Departmentadd($request)
    {
        Department::create([
            'name' => $request->name,
            'description' => $request->description,

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
