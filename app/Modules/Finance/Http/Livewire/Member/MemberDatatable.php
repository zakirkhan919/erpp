<?php

namespace App\Modules\Finance\Http\Livewire\Member;

use App\Models\Member;
use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class MemberDatatable extends LivewireDatatable
{
    public $model = Member::class;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('নাম্বার')
                ->sortBy('id'),

            Column::name('name')
                ->label('নাম'),
            Column::name('village')
                ->label('গ্রাম'),

        ];
    }
}
