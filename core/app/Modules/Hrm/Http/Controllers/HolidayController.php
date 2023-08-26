<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\FixedHoliday;
use App\Modules\Hrm\Models\OccasionHoliday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function Holiday()
    {
        $date = Carbon::now()->format('Y');
        $fixedHoliday = FixedHoliday::orderby('id', 'asc')->get();
        $period = CarbonPeriod::create('2023-01-01', '2023-12-31');

        $dates = [];
        foreach ($period as $date) {
            $day_name = $date->format('l');
            foreach ($fixedHoliday as $fix) {
                if ($fix->day == $day_name) {
                    array_push($dates, $date->format('Y-m-d'));
                }
            }
        }

        $occasionHoliday = OccasionHoliday::whereYear('date', $date)->whereMonth('date', Carbon::JANUARY)->get();
        return view('Hrm::holiday.index', compact('dates', 'fixedHoliday', 'occasionHoliday'));
    }

    public function getHoliday(Request $request)
    {
        $date = Carbon::now()->format('Y');
        $month = $request->data;
        

        $occasionHoliday = OccasionHoliday::whereYear('date', $date)->whereMonth('date', Carbon::createFromFormat('M', $month))->get();
        
        $view = view('Hrm::holiday.ajax_occasion', compact('occasionHoliday'))->render();

        return response()->json($view);
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

    public function updateOccasionHoliday(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'occasion' => 'required'
        ]);

        $data = OccasionHoliday::find($request->id);
        $data->date = $request->date;
        $data->occasion = $request->occasion;
        $data->description = $request->description;
        $data->save();

        return redirect()->back()->with('success', 'Successfully Updated');
    }



    public function getOccasionHoliday(Request $request)
    {
        $data = OccasionHoliday::where('id', $request->data)->first();
        $html_view = view('Hrm::holiday.edit_holiday', compact('data'))->render();

        return response()->json($html_view);
    }

    public function deleteOccasionHoliday(Request $request)
    {
        // dd($request->all());
        $data = OccasionHoliday::find($request->data);
        $data->delete();

        return response()->json('success');
    }
}
