<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditAmount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function deleteAmountData($request)
    {
        $id = decrypt($request->id);
        $creditAmount = CreditAmount::find($id);
        if ($creditAmount) {
            $creditAmount->delete();
        }
    }
}