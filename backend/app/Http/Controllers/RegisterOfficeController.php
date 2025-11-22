<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CriminalRecord;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RegisterOfficeController extends Controller
{
    public function RegisterOfficeDashboard()
    {
        return view('register_office.index');
    }

    public function RegisterOfficeLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function RegisterOfficeLogin()
    {
        return view('login');
    }

    public function RegisterOfficeProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view(
            'register_office.register_office_profile_view',
            compact('profileData')
        );
    }

    public function RegisterOfficeProfileStore(Request $request)
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

    public function RegisterOfficeChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view(
            'register_office.register_office_change_password',
            compact('profileData')
        );
    }

    public function RegisterOfficeUpdatePassword(Request $request)
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

    public function RegisterOfficeChat()
    {
        return view('register_office.RegisterOfficechat');
    }
    public function RegisterOfficePosts()
    {
        return view('register_office.posts');
    }

    public function RegisterOfficeShowMember()
    {
        $types = User::latest()->get();
        return view('register_office.showmember', compact('types'));
    }

    public function RegisterOfficeRecordcriminalinformation()
    {
        return view('register_office.recordcriminalinformation');
    }

    public function RegisterOfficestorecriminalrecord(Request $request)
    {       
        $request->validate([
            'fname' => 'nullable|string',
            'mname' => 'nullable|string',
            'lname' => 'nullable|string',
            'nickname' => 'nullable|string',
            'gender' => 'required|string',
            'photo' => 'nullable|image',
            'nationality' => 'nullable|string',
            'idnumber' => 'nullable|string',
            'address' => 'nullable|string',
            'recordnumber' => 'nullable|string',
            'typeofcrime' => 'nullable|string',    
            'arrestdate' => 'nullable|string',
            'releasedate' => 'nullable|string',
            'familyname' => 'nullable|string',
            'relationship' => 'nullable|string',
            'contactinfo' => 'nullable|string',




    
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/admin_image/');

            // Create directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $photoPath = $filename;
        }

        // Create user with photo path
        CriminalRecord::create([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'photo' => $photoPath,
            'nationality' => $request->nationality,
            'idnumber' => $request->idnumber,
            'address' => $request->address,
            'recordnumber' => $request->recordnumber,
            'typeofcrime' => $request->typeofcrime,    
            'arrestdate' => $request->arrestdate,
            'releasedate' => $request->releasedate,
            'familyname' => $request->familyname,
            'relationship' => $request->relationship,
            'contactinfo' => $request->contactinfo,



        ]);

        $notification = [
            'message' => 'Recorded successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('RegisterOffice.dashboard')
            ->with($notification);
    }

    public function RegisterOfficeShowRecordedCriminal()
    {
        $types = CriminalRecord::latest()->get();
        return view('register_office.showrecordedcriminal', compact('types'));
    }


    
    //
}
