<?php

namespace App\Http\Controllers;

use App\Models\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuspectController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'description' => 'required|string',
            'address' => 'nullable|string|max:500',
            'last_known_location' => 'required|string|max:255',
            'status' => 'required|in:wanted,missing,person_of_interest',
            'video' => 'nullable', // 50MB
            'audio' => 'nullable', // 20MB
        ], [
            'video.max' => 'The video must not be greater than 50MB.',
            'audio.max' => 'The audio must not be greater than 20MB.',
            'video.mimetypes' => 'The video must be a file of type: mp4, mov, avi.',
            'audio.mimetypes' => 'The audio must be a file of type: mp3, wav, ogg.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
     
            $videoPath = null;
            if ($request->hasFile('video')) {
                $videoPath = $this->storeFile($request->file('video'), 'videos');
            }

            $audioPath = null;
            if ($request->hasFile('audio')) {
                $audioPath = $this->storeFile($request->file('audio'), 'audios');
            }

            // Create suspect record
            $suspect = Suspect::create([
                'full_name' => $request->full_name,
                'age' => $request->age,
                'gender' => $request->gender,
                'description' => $request->description,
                'address' => $request->address,
                'last_known_location' => $request->last_known_location,
                'status' => $request->status,
                'video_path' => $videoPath,
                'audio_path' => $audioPath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Suspect report created successfully',
                'data' => $suspect
            ], 201);

        } catch (\Exception $e) {
            // Clean up uploaded files if something went wrong
            if (isset($videoPath)) {
                Storage::delete($videoPath);
            }
            if (isset($audioPath)) {
                Storage::delete($audioPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to create suspect report',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store uploaded file with unique filename
     */
    private function storeFile($file, $directory)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs($directory, $filename, 'public');

        return $path;
    }

    /**
     * Get the list of allowed mime types for validation
     */
    public function getAllowedMimeTypes()
    {
        return response()->json([
            'video' => ['mp4', 'mov', 'avi'],
            'audio' => ['mp3', 'wav', 'ogg']
        ]);
    }
}