<?php

namespace App\Modules\Finance\Http\Livewire\Transection;

use App\Models\SpendAmount;
use Livewire\Component;

class SpendFormEdit extends Component
{
    public $description = null;
    public $amount = null;
    public $date = null;

    public $status = 1;
    public $spendAmountId = null;

    public function mount($id)
    {
        $memberData = SpendAmount::findOrFail($id);
        $this->spendAmountId        = $id;
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

        $creditUpdate = SpendAmount::where('id', $this->spendAmountId)->update([
            'description'           => $this->description,
            'amount'              => $this->amount,
            'date'              => $this->date,
            'status'            => $this->status,
        ]);

        if ($creditUpdate) {
            session()->flash('message', 'সফলভাবে পরিবর্তন করা হয়েছে।');
            return redirect()->to('/amount/spend');
        } else {
            echo "something wrong";
        }
    }

    public function render()
    {
        return view('Finance::livewire.transection.spend-form-edit');
    }
}
