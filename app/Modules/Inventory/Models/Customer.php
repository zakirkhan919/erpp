<?php

namespace App\Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sales()
    {
        return $this->hasMany(Sell::class, 'customer_id', 'id');
    }

    public static function Customeradd($request)
    {
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }

    public static function Customerupdated($request)
    {
        $data = Customer::find($request->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->save();
    }

    public static function deleteCustomer($request)
    {
        $id = decrypt($request->id);
        $data = Customer::find($id);
        if ($data) {
            $data->delete();
        }
    }
}
