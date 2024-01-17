<?php

namespace App\Modules\Finance\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function front()
    {
        return view('Finance::frontend.home.home');
    }
}
