<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function Selladd($request)
    {
        Sell::create([
            "custormer_id" => $request->custormer_id,
            "seller_id" => $request->seller_id,
            "product_id" => $request->product_id,
            'selling_date' => $request->selling_date,
            'selling_quantity' => $request->selling_quantity,
        ]);
    }

    public static function Sellupdated($request)
    {
        $data = Sell::find($request->id);

        $data->custormer_id = $request->custormer_id;
        $data->seller_id = $request->seller_id;
        $data->product_id = $request->product_id;
        $data->selling_date = $request->selling_date;
        $data->selling_quantity = $request->selling_quantity;
        $data->save();
    }

    public static function deleteSell($request)
    {
        $id = decrypt($request->id);
        $data = Sell::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
