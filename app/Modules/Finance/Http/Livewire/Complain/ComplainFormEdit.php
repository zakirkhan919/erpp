<?php

namespace App\Modules\Finance\Http\Livewire\Complain;

use App\Models\Complain;
use App\Models\Member;
use Livewire\Component;

class ComplainFormEdit extends Component
{
    public $member_id = null;
    public $name = null;
    public $number = null;
    public $description = null;
    public $complainId = null;

    public function mount($id)
    {
        $complainData = Complain::findOrFail($id);
        $this->complainId        = $id;
        $this->member_id        = $complainData->member_id;
        $this->name        = $complainData->name;
        $this->number        = $complainData->number;
        $this->description        = $complainData->description;
    }

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

        $complain = Complain::where('id', $this->complainId)->update([
            'member_id'        => $this->member_id,
            'name'             => $this->name,
            'number'               => $this->number,
            'description'             => $this->description,
        ]);

        if ($complain) {
            session()->flash('message', 'সফলভাবে পরিবর্তন করা হয়েছে।');
            return redirect()->to('/complains');
        } else {
            echo "something wrong";
        }
    }

    public function render()
    {
        $members = Member::where('status', 1)->get();
        return view('livewire.complain.complain-form-edit', compact('members'));
    }
}
