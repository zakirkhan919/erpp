<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function Designationadd($request)
    {
        Designation::create([
            'name' => $request->name,
            'description' => $request->description,

        ]);
    }

    public static function Designationupdated($request)
    {
        $data = Designation::find($request->id);

        $data->name = $request->name;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->save();
    }

    public static function deleteDesignation($request)
    {
        $id = decrypt($request->id);
        $data = Designation::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
