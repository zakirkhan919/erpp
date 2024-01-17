<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(MemberType::class, 'type_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Upazila::class, 'thana_id', 'id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public static function deleteMemberData($request)
    {

        $id = decrypt($request->id);
        $member = Member::find($id);
        if ($member) {
            $member->delete();
        }
    }
}