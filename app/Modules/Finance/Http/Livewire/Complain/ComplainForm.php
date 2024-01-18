<?php

namespace App\Modules\Finance\Http\Livewire\Complain;

use App\Models\Complain;
use App\Models\Member;
use Livewire\Component;
use DB;

class ComplainForm extends Component
{
    public $member_id = null;
    public $name = null;
    public $number = null;
    public $description = null;

    public function save()
    {
        $this->validate(
            [
                'member_id'       => 'required',
                'name'            => 'required',
                'number'              => 'Required',
                'description'            => 'Required',
            ],
            [
                'member_id.required'   => "ফিল্ডটি পুরন করতে হবে!",
                'name.required'        => "ফিল্ডটি পুরন করতে হবে!",
                'number.required'          => "ফিল্ডটি পুরন করতে হবে!",
                'description.required'        => "ফিল্ডটি পুরন করতে হবে!",
            ]
        );

        $complain = Complain::create([
            'member_id'        => $this->member_id,
            'name'             => $this->name,
            'number'               => $this->number,
            'description'             => $this->description,
        ]);

        if ($complain) {
            session()->flash('message', 'সফলভাবে যোগ করা হয়েছে।');
            return redirect()->to('/complains');
        } else {
            echo "something wrong";
        }
    }
    public function render()
    {
        // $members = Member::where('status', 1)->select('id', 'name')->get();
        $members = DB::table('members')->where('status', 1)->select('id', 'name', 'u_id')->get();
        return view('livewire.complain.complain-form', compact('members'));
    }
}
