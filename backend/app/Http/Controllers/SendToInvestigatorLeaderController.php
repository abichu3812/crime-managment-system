<?php

namespace App\Http\Controllers;

use App\Models\SendToInvestigatorLeader;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SendToInvestigatorLeaderController extends Controller
{

public function SentInvestigationReportToLeader(Request $request)
{
    // Validate all input fields with proper rules
    $request->validate([
        'full_name' => 'required|string|max:255',
        'age' => 'nullable|integer|min:1|max:120',
        'gender' => 'nullable|in:male,female,other',
        'personal_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
        'interview' => 'nullable|string',
        'additional_notes' => 'nullable|string',
        'dna_evidence' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:5120', // 5MB
        'video_evidence' => 'nullable|file|mimes:mp4,mov,avi|max:20480', // 20MB
        'audio_evidence' => 'nullable|file|mimes:mp3,wav|max:10240', // 10MB
    ]);

    // Directory configuration
    $uploadDirectory = public_path('upload/investigation_reports/');
    
    // Create directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0755, true);
    }

    // Process file uploads with a helper function
    $uploadFile = function ($file) use ($uploadDirectory) {
        if (!$file) return null;
        
        $extension = $file->getClientOriginalExtension();
        $filename = 'report_' . date('YmdHis') . '_' . Str::random(8) . '.' . $extension;
        
        try {
            $file->move($uploadDirectory, $filename);
            return $filename;
        } catch (\Exception $e) {
            Log::error("File upload failed: " . $e->getMessage());
            return null;
        }
    };

    // Handle all file uploads
    $fileFields = [
        'personal_photo',
        'dna_evidence',
        'video_evidence',
        'audio_evidence'
    ];

    $filePaths = [];
    foreach ($fileFields as $field) {
        $filePaths[$field] = $request->hasFile($field) 
            ? $uploadFile($request->file($field)) 
            : null;
    }

    // Create the investigation report
    try {
        SendToInvestigatorLeader::create([
            'full_name' => $request->full_name,
            'age' => $request->age,
            'gender' => $request->gender,
            'personal_photo' => $filePaths['personal_photo'],
            'interview' => $request->interview,
            'additional_notes' => $request->additional_notes,
            'dna_evidence' => $filePaths['dna_evidence'],
            'video_evidence' => $filePaths['video_evidence'],
            'audio_evidence' => $filePaths['audio_evidence'],
            'submitted_by' => auth()->user()->id,
            'submitted_at' => now(),
        ]);

        $notification = [
            'message' => 'Investigation report sent successfully to the leader',
            'alert-type' => 'success',
        ];

        return redirect()
            ->route('Investigator.dashboard')
            ->with($notification);

    } catch (\Exception $e) {
        // Clean up uploaded files if database operation fails
        foreach ($filePaths as $filePath) {
            if ($filePath && file_exists($uploadDirectory . $filePath)) {
                unlink($uploadDirectory . $filePath);
            }
        }

        Log::error("Investigation report submission failed: " . $e->getMessage());

        return back()
            ->withInput()
            ->with([
                'message' => 'Failed to submit investigation report. Please try again.',
                'alert-type' => 'error'
            ]);
    }
}
    //
}
