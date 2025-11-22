<?php

namespace App\Http\Controllers;
use App\Models\Report;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //CommonShowCriminalReport

    public function CommonShowCriminalReport()
    {
        $types = Report::latest()->get();
        return view('common.criminalreport', compact('types'));
    }
}
