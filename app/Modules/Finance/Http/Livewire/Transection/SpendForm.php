<?php

namespace App\Http\Livewire\Transection;

use App\Models\SpendAmount;
use Livewire\Component;

class SpendForm extends Component
{

    public $description = null;
    public $amount = null;
    public $date = null;

    public $status = 1;

    public function save()
    {
        $this->validate(
            [
                'description'       => 'required',
                'amount'            => 'required',
                'date'              => 'Required',
                'status'            => 'Required',
            ],
            [
                'description.required'   => "ফিল্ডটি পুরন করতে হবে!",
                'amount.required'        => "ফিল্ডটি পুরন করতে হবে!",
                'date.required'          => "ফিল্ডটি পুরন করতে হবে!",
                'status.required'        => "ফিল্ডটি পুরন করতে হবে!",
            ]
        );

        $creditAmount = SpendAmount::create([
            'description'        => $this->description,
            'amount'             => $this->amount,
            'date'               => $this->date,
            'status'             => $this->status,

        ]);

        if ($creditAmount) {
            session()->flash('message', 'সফলভাবে যোগ করা হয়েছে।');
            return redirect()->to('/amount/spend');
        } else {
            echo "something wrong";
        }
    }

    public function render()
    {
        return view('livewire.transection.spend-form');
    }
}