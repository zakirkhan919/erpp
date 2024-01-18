<?php

namespace App\Modules\Finance\Http\Livewire\Member;

use App\Models\Country;
use App\Models\Distric;
use App\Models\District;
use App\Models\Member;
use App\Models\MemberType;
use App\Models\PostOffice;
use App\Models\Union;
use App\Models\Upazila;
use Livewire\WithFileUploads;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use Image;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Str;

class MemberForm extends Component
{
    use WithFileUploads;
    public $name = null;
    public $ref = null;
    public $district = null;
    public $thana = null;
    public $union = null;
    public $village = null;
    public $postOffice = null;
    public $postoffice = null;
    public $image = null;
    public $reference = null;
    public $country = null;
    public $nid = null;
    public $blood_group = null;
    public $phone = null;



    public $type_id = null;

    public $thanas = null;

    public $unions = null;
    public $union_id = null;

    public $status = 1;
    public $new_location = null;



    public function updatedDistrict($value)
    {
        $this->thanas = Upazila::where('district_id', $value)->get();
    }

    public function updatedThana($value)
    {
        $this->postoffice   = PostOffice::where('upazila_id', $value)->get();
        $this->unions       = Union::where('upazilla_id', $value)->get();
    }
    public function save()
    {
        $this->validate(
            [

                'name'          => 'required',
                'ref'           => 'required',
                'district'      => 'required',
                'thana'         => 'required',
                'village'       => 'required',
                'country'       => 'required',
                'phone'         => 'required|max:11|min:11|unique:members',
            ],
            [
                'name.required'         => "ফিল্ডটি পুরন করতে হবে!",
                'ref.required'          => "ফিল্ডটি পুরন করতে হবে!",
                'district.required'     => "ফিল্ডটি পুরন করতে হবে!",
                'thana.required'        => "ফিল্ডটি পুরন করতে হবে!",
                'village.required'      => "ফিল্ডটি পুরন করতে হবে!",
                'country.required'      => "ফিল্ডটি পুরন করতে হবে!",
                'phone.required'        => "ফিল্ডটি পুরন করতে হবে!!",
                'phone.unique'          => "নাম্বার একবার অ্যাড করা হয়েছে!!!",
                'phone.max'             => "নাম্বার সর্বচ্ছ ১১ সংখার দিতে পারবেন!!!",
            ]
        );

        if ($this->image) {
            $image      = $this->image;
            $filename    = "image-" . time() . ".png";
            $this->new_location = 'assets/uploads/members/' . $filename;
            Image::make($image)->save($this->new_location);
        }
        $districtName = District::where('id', $this->district)->first();
        $prefixName =substr($districtName->name, 0, 3);

        // $id = UniqueIdGenerator::generate(['table' => 'members', 'length' => 10,'prefix' => date('y')]);
        $today = date('Ymd');
        $lastId = Member::latest('id')->first();

        $initial = 0;

        $member = Member::create([
            'type_id'           => $this->type_id,
            'name'              => $this->name,
            'ref'               => $this->ref,
            'country_id'        => $this->country,
            'district_id'       => $this->district,
            'thana_id'          => $this->thana,
            'union_id'          => $this->union_id,
            'u_id'              => $lastId ? $lastId->u_id + 1 : 1,
            'village'           => $this->village,
            'postOffice'        => $this->postOffice,
            'reference'         => $this->reference,
            'nid'               => $this->nid,
            'phone'             => $this->phone,
            'blood_group'       => $this->blood_group,
            'image'             => $this->new_location,
            'status'            => $this->status,

        ]);

        if ($member) {
            session()->flash('message', 'সফলভাবে যোগ করা হয়েছে।');
            return redirect()->to('/members');
        } else {
            echo "something wrong";
        }
    }

    public function render()
    {
        $districts = District::all();
        $types = MemberType::where('status', 1)->get();
        $countries = Country::whereNotNull('bn_name')->get();
        return view('livewire.member.member-form', compact('districts', 'types', 'countries'));
    }
}
