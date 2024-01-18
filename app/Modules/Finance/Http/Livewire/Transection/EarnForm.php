<?php

namespace App\Modules\Finance\Http\Livewire\Transection;

use App\Models\CreditAmount;
use Livewire\Component;

class EarnForm extends Component
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

        $creditAmount = CreditAmount::create([
            'description'        => $this->description,
            'amount'             => $this->amount,
            'date'               => $this->date,
            'status'             => $this->status,

        ]);

        if ($creditAmount) {
            session()->flash('message', 'সফলভাবে যোগ করা হয়েছে।');
            return redirect()->to('/amount/credit');
        } else {
            echo "something wrong";
        }
    }

    public function render()
    {
        return view('Finance::livewire.transection.earn-form');
    }
}