<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct()
    {
        $this->database = (new Factory)
            ->withServiceAccount(config('services.firebase.credentials'))
            ->withDatabaseUri('https://flutter-firebase-cloudinary2-default-rtdb.firebaseio.com/') // Correct URL
            ->createDatabase();
    }

    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            $this->database->getReference('messages')->push($data);
            return back()->with('success', 'Message sent to Firebase successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Firebase error: ' . $e->getMessage());
        }
    }
}