<?php

namespace App\Modules\Finance\Http\Livewire\Member;

use App\Models\District;
use App\Models\Member;
use App\Models\PostOffice;
use App\Models\Upazila;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class SearchForm extends Component
{
    public $districts = null;
    public $district = null;
    public $thanas = null;
    public $thana = null;

    public $post_offices = null;

    public $villages = null;

    public $postoffice = null;

    public $village = null;

    public $searchData = null;

    public $chacktable = null;

    public $unionid = null;

    public function updatedDistrict($value)
    {

        $this->thanas = Upazila::where('district_id', $value)->get();
    }
    public function updatedUnionid($value)
    {

        $this->thanas = Upazila::where('district_id', $value)->get();
    }

    public function updatedThana($value)
    {
        $this->post_offices = PostOffice::where('upazila_id', $value)->get();

    }

    public function updatedPostoffice($value)
    {
        // dd('okay');
        $this->villages = Member::where('postOffice', $value)->groupBy('village')->get();
    }

    public function save()
    {
        $this->chacktable = 1;
        $this->validate(
            [
                'district' => 'required',
                'thana' => 'required',
                'postoffice' => 'required',
                'village' => 'required',
            ],
            [
                'district.required'         => "ফিল্ডটি পুরন করতে হবে!",
                'thana.required'         => "ফিল্ডটি পুরন করতে হবে!",
                'postoffice.required'         => "ফিল্ডটি পুরন করতে হবে!",
                'village.required'         => "ফিল্ডটি পুরন করতে হবে!",
            ]
        );

        // dd($this->village);
        $this->searchData = Member::where('district_id', $this->district)
        ->where('thana_id', $this->thana)
        ->where('postOffice', $this->postoffice)
        ->where('village', $this->village)
        ->get();

        // return view('admin.member.search_data');
    }

    public function render()
    {
        $this->districts = District::all();
        // $this->thanas = Upazila::get();
        return view('livewire.member.search-form');
    }
}
