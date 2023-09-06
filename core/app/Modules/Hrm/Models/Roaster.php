<?php

namespace App\Modules\Hrm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roaster extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class,'emp_id','id');
    }

}
