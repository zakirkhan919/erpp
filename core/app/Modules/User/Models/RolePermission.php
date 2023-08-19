<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    public static function RolePermissionList(){
        return RolePermission::orderby("id","desc")->get([
            "id",
            "name",
            "permission"
        ]);
    }

}
