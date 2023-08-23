<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $data->price = $request->price;
        $data->category = $request->category;
        $data->save();
    }

    public static function deleteDepartment($request)
    {
        $id = decrypt($request->id);
        $data = Department::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
