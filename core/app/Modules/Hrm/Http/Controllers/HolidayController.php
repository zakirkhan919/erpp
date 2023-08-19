<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\FixedHoliday;
use App\Modules\Hrm\Models\OccasionHoliday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function Holiday()
    {
        return view('Hrm::holiday.index');
    }

    public function addHoliday()
    {
        return view('Hrm::holiday.add_holiday');
    }

    public function SubmitFixedHoliday(Request $request)
    {
        $request->validate([
            'confirm' => 'required'
        ]);

        if ($request->fixedholidays && is_array($request->fixedholidays)) {
            FixedHoliday::orderby('id', 'desc')->delete();
            foreach ($request->fixedholidays as $holiday) {
                $data = new FixedHoliday();
                $data->day = $holiday;
                $data->save();
            }
        }

        return redirect()->back()->with('success', 'Successfully added');
    }

    public function SubmitOccasionHoliday(Request $request)
    {
        
        $request->validate([
            'date' => 'required',
            'occasion' => 'required'
        ]);

        $data = new OccasionHoliday();
        $data->date = $request->date;
        $data->occasion = $request->occasion;
        $data->description = $request->description;
        $data->save();

        return redirect()->back()->with('success1', 'Successfully added');
    
    }
}
