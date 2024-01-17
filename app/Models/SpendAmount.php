<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpendAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function deleteAmountData($request)
    {
        $id = decrypt($request->id);
        $spendAmount = SpendAmount::find($id);
        if ($spendAmount) {
            $spendAmount->delete();
        }
    }
}