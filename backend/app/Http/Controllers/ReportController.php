<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reporting;
class ReportController extends Controller
{
    //

    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'incident_date' => 'nullable',
            'incident_time' => 'nullable',
            'location' => 'nullable',
            'description' => 'required',
            'file_path' => 'nullable||image|mimes:jpeg,png,jpg,gif',
            'suspect_Information' => 'nullable',
            'witness_Information' => 'nullable|string|max:15',
            'reporter_name' => 'nullable|string|max:100',
            'reporter_email' => 'nullable|string|max:100',
            'reporter_phone' => 'nullable|string|max:255',
    
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/Report/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $photoPath = $filename;
        }

        // Create user with photo path
        reporting::create([
            'incident_date' => $request->incident_date,
            'incident_time' => $request->incident_time,
            'location' => $request->location,
            'description' => $request->description,
            'file_path' => $request->file_path,
            'suspect_Information' => $suspect_Information,
            'witness_Information' => $request->witness_Information,
            'reporter_name' => $request->reporter_name,
            'reporter_email' => $request->reporter_email,
            'reporter_phone' => $request->reporter_phone,
    
        ]);

        $notification = [
            'message' => 'New member created successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('crimereporting')
            ->with($notification);
    }
}
