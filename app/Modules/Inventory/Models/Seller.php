<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'seller_id', 'id');
    }
    public function sales()
    {
        return $this->hasMany(Sell::class, 'seller_id', 'id');
    }

    public static function Selleradd($request)
    {
        Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }

    public static function Sellerupdated($request)
    {
        $data = Seller::find($request->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();
    }

    public static function deleteSeller($request)
    {
        $id = decrypt($request->id);
        $data = Seller::find($id);

        if ($data) {
            $data->delete();
        }
    }
}
