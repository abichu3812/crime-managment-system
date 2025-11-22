<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SentToInvestigator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class InvestigatorController extends Controller
{
    public function InvestigatorDashboard()
    {
        return view('investigator.index');
    }

    public function InvestigatorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function InvestigatorLogin()
    {
        return view('login');
    }

    public function InvestigatorProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view(
            'investigator.investigator_profile_view',
            compact('profileData')
        );
    }

    public function InvestigatorShowMember()
    {
        $types = User::latest()->get();
        return view('investigator.showmember', compact('types'));
    }

    public function InvestigatorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('ymdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'investigation_leader profile Update Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function InvestigatorChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view(
            'investigator.investigator_change_password',
            compact('profileData')
        );
    }

    public function InvestigatorUpdatePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = [
                'message' => 'Old Password does not match',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password Change Successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }


    public function InvestigatorShowReportSentFromInvestigatorLeader()
    {
        $types = SentToInvestigator::latest()->get();
        return view('investigator.receivereport', compact('types'));
    }

    public function InvestigatorSendOverAllInvestigation()
    {
        return view('investigator.sendoverallinvestigation');
    }

    public function SentInvestigationReportToLeader(Request $request)
    {
        $request->validate([
            'full_name' => 'nullable',
            'age' => 'nullable',
            'gender' => 'nullable',
            'personal_photo' => 'nullable|image',
            'interview' => 'nullable',
            'dna_evidence' => 'nullable|image',
            'forensic_evidence' => 'nullable|image',
            'clinical_report' => 'nullable|image',
        
        ]);

        // Handle photo upload
        $personal_photoPath = null;
        if ($request->hasFile('personal_photo')) {
            $file = $request->file('personal_photo');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/suspect_info/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $personal_photoPath = $filename;
        }

        $dna_evidencePath = null;
        if ($request->hasFile('dna_evidence')) {
            $file = $request->file('dna_evidence');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/suspect_info/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $dna_evidencePath = $filename;
        }

        $forensic_evidencePath = null;
        if ($request->hasFile('forensic_evidence')) {
            $file = $request->file('forensic_evidence');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/suspect_info/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $forensic_evidencePath = $filename;
        }

        $clinical_reportPath = null;
        if ($request->hasFile('clinical_report')) {
            $file = $request->file('clinical_report');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/suspect_info/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $clinical_reportPath = $filename;
        }

        // Create user with personal_photo path
        SendToInvestigatorLeader::create([
            'full_name' => $request->full_name,
            'age' => $request->age,
            'gender' => $request->gender,
            
            'personal_photo' => $personal_photoPath,
            
            'interview' => $request->interview,
            'dna_evidence' => $request->dna_evidence,
            'forensic_evidence' => $request->forensic_evidence,
            'clinical_report' => $request->clinical_report,
            
        ]);

        $notification = [
            'message' => 'Sent successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('Investigator.dashboard')
            ->with($notification);
    }




    //
}
