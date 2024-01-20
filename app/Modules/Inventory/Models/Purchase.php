<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id', 'id');

    }

    public static function Purchaseadd($request)
    {
        Purchase::create([
            "product_id" => $request->product_id,
            "seller_id" => $request->seller_id,
            'purchase_date' => $request->purchase_date,
            'quantity' => $request->quantity,
        ]);
    }

    public static function Purchaseupdated($request)
    {
        $data = Purchase::find($request->id);

        $data->product_id = $request->product_id;
        $data->seller_id = $request->seller_id;
        $data->purchase_date = $request->purchase_date;
        $data->quantity = $request->quantity;
        $data->save();
    }

    public static function deletePurchase($request)
    {
        $id = decrypt($request->id);
        $data = Purchase::find($id);
        if ($data) {
            $data->delete();
        }
    }

}
