<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealRegister extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function member()
    {
        return $this->belongsTo(Member::class, 'team_id', 'id');
    }
}
