<?php

namespace App\Http\Livewire\Transection;

use App\Models\CreditAmount;
use Livewire\Component;

class EarnFormEdit extends Component
{
    public $description = null;
    public $amount = null;
    public $date = null;

    public $status = 1;
    public $creditAmountId = null;

    public function mount($id)
    {
        $memberData = CreditAmount::findOrFail($id);
        $this->creditAmountId        = $id;
        $this->description        = $memberData->description;
        $this->amount        = $memberData->amount;
        $this->date        = $memberData->date;
        $this->status        = $memberData->status;
    }

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

        $creditUpdate = CreditAmount::where('id', $this->creditAmountId)->update([
            'description'           => $this->description,
            'amount'              => $this->amount,
            'date'              => $this->date,
            'status'            => $this->status,
        ]);

        if ($creditUpdate) {
            session()->flash('message', 'সফলভাবে পরিবর্তন করা হয়েছে।');
            return redirect()->to('/amount/credit');
        } else {
            echo "something wrong";
        }
    }
    public function render()
    {
        return view('livewire.transection.earn-form-edit');
    }
}