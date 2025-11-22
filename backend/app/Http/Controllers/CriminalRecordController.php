<?php

namespace App\Http\Controllers;
use App\Models\CriminalRecord;

use Illuminate\Http\Request;

class CriminalRecordController extends Controller
{
    //
    public function Adminshowrecordedcriminal()
    {
        $types = CriminalRecord::latest()->get();
        return view('admin.showrecordedcriminal', compact('types'));
    }
}
