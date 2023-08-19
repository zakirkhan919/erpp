<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
