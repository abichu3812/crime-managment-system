<?php

namespace App\Http\Controllers;
use App\Models\SentToInvestigator;

use Illuminate\Http\Request;

class SentToInvestigatorController extends Controller
{
    //


    public function InvestigatorLeaderSentToInvestigator(Request $request)
    {
        $request->validate([
            'full_name' => 'nullable',
            'age' => 'nullable',
            'gender' => 'nullable',
            'description' => 'nullable',
            'address' => 'nullable|string',
            'last_known_location' => 'nullable',
            'status' => 'nullable',
      
        ]);

        // Handle photo upload
    

        // Create user with photo path
        SentToInvestigator::create([
            'full_name' => $request->full_name,
            'age' => $request->age,
            'gender' => $request->gender,
            
            'description' => $request->description,
           
            'address' => $request->address,
            
            'last_known_location' => $request->last_known_location,
            'status' => $request->status,
         
        ]);

        $notification = [
            'message' => 'New member created successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('InvestigatorLeader.sendsuspecttoinvestigator')
            ->with($notification);
    }
}
