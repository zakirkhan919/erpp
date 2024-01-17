<?php

namespace App\Http\Livewire\Member;

use App\Models\Country;
use Livewire\Component;
use App\Models\District;
use App\Models\Member;
use App\Models\MemberType;
use App\Models\PostOffice;
use App\Models\Union;
use App\Models\Upazila;
use Livewire\WithFileUploads;
use PhpParser\Node\Expr\FuncCall;
use Image;

class MemberFormEdit extends Component
{
    use WithFileUploads;
    public $name = null;
    public $ref = null;
    public $district = null;
    public $thana = null;
    public $union_id = null;
    public $village = null;
    public $postOffice = null;
    public $postoffice = null;
    public $image = null;
    public $reference = null;
    public $country = null;
    public $nid = null;
    public $phone = null;
    public $blood_group = null;
    public $type_id = null;

    public $thanas = null;

    public $unions = null;

    public $status = null;

    public $memberId = null;

    public $imageShow = null;

    public $new_location = null;

    public function mount($id)
    {
        $memberData = Member::findOrFail($id);
        $this->memberId        = $id;
        $this->type_id        = $memberData->type_id;
        $this->name        = $memberData->name;
        $this->ref        = $memberData->ref;
        $this->district        = $memberData->district_id;
        $this->thana        = $memberData->thana_id;
        $this->union_id        = $memberData->union_id;
        $this->village        = $memberData->village;
        $this->postOffice        = $memberData->postOffice;
        $this->imageShow        = $memberData->image;
        $this->status        = $memberData->status;

        $this->reference = $memberData->reference;
        $this->country = $memberData->country_id;
        $this->nid = $memberData->nid;
        $this->phone = $memberData->phone;
        $this->blood_group = $memberData->blood_group;
    }

    public function updatedDistrict($value)
    {
        $this->thanas = Upazila::where('district_id', $value)->get();
    }

    public function updatedThana($value)
    {
        $this->postoffice = PostOffice::where('upazila_id', $value)->get();
        $this->unions       = Union::where('upazilla_id', $value)->get();
    }

    public function save()
    {

        if ($this->image) {
            $image      = $this->image;
            $filename    = "image-" . time() . ".png";
            $this->new_location = 'assets/uploads/members/' . $filename;
            Image::make($image)->save($this->new_location);
        }



        $member = Member::where('id', $this->memberId)->update([
            'type_id'           => $this->type_id,
            'name'              => $this->name,
            'ref'               => $this->ref,
            'country_id'        => $this->country,
            'district_id'       => $this->district,
            'thana_id'          => $this->thana,
            'union_id'          => $this->union_id,
            'village'           => $this->village,
            'postOffice'        => $this->postOffice,
            'reference'         => $this->reference,
            'nid'               => $this->nid,
            'phone'             => $this->phone,
            'blood_group'       => $this->blood_group,
            'image'             => $this->new_location ? $this->new_location : $this->imageShow,
            'status'            => $this->status,
        ]);

        if ($member) {
            session()->flash('message', 'সফলভাবে পরিবর্তন করা হয়েছে।');
            return redirect()->to('/members');
        } else {
            echo "something wrong";
        }
    }
    public function render()
    {
        $districts = District::all();
        $types = MemberType::where('status', 1)->get();
        $this->thanas = Upazila::where('district_id', $this->district)->get();
        $this->postoffice = PostOffice::where('upazila_id', $this->thana)->get();
        $this->unions     = Union::where('upazilla_id', $this->thana)->get();
        $countries = Country::whereNotNull('bn_name')->get();
        return view('livewire.member.member-form-edit', compact('districts', 'types', 'countries'));
    }
}
