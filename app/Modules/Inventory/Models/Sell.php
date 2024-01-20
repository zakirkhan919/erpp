<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public static function Selladd($request)
    {
        Sell::create([
            "customer_id" => $request->customer_id,
            "seller_id" => $request->seller_id,
            "product_id" => $request->product_id,
            'selling_date' => $request->selling_date,
            'selling_quantity' => $request->selling_quantity,
        ]);
    }

    public static function Sellupdated($request)
    {
        $data = Sell::find($request->id);

        $data->customer_id = $request->customer_id;
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
