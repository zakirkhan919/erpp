<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function Productadd($request)
    {
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
        ]);
    }

    public static function Productupdated($request)
    {
        $data = Product::find($request->id);

        $data->name = $request->name;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->save();
    }

    public static function deleteProduct($request)
    {
        $id = decrypt($request->id);
        $data = Product::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
