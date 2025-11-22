<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Report;
use App\Models\Suspect;
use App\Models\reporting;

class AdminController extends Controller
{
    public function showReportingForm()
    {
        return view('reporting_criminal');
    }

    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); // Destroy the session
        $request->session()->regenerateToken(); // Regenerate CSRF token
    
        // Redirect with headers to prevent caching
        return redirect('/')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate') // HTTP 1.1
            ->header('Pragma', 'no-cache') // HTTP 1.0
            ->header('Expires', '0'); // Proxies
    }
    

    public function AdminLogin()
    {
        return view('login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
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
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminUpdatePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = [
                'message' => 'Old password does not match',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        $notification = [
            'message' => 'Password changed successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);
    }





    public function AdminAddMember()
    {
        return view('admin.addmember');
    }

    public function AdminShowMember()
    {
        $types = User::latest()->get();
        return view('admin.showmember', compact('types'));
    }

    public function AdminShowCriminalReport()
    {
        $types = Suspect::latest()->get();
        return view('admin.criminalreport', compact('types'));
    }


    public function AdminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:200',
            'username' => 'required|unique:users|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'gender' => 'required|string',
            'photo' => 'nullable|image',
            'phone' => 'nullable|string|max:15',
        
            'department' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'role' => 'required|string|max:50',
            'status' => 'required|string',
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
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'photo' => $photoPath,
            'phone' => $request->phone,
            
            'department' => $request->department,
            'address' => $request->address,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'New member created successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }

    public function CriminalStore(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'gender' => 'required|string',
            'photo' => 'nullable|image',
            'repotext' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
        
            'address' => 'nullable|string|max:255',
    
        ]);

    
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHis') . '_' . $file->getClientOriginalName(); // Unique filename
            $path = public_path('upload/Report/');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $photoPath = $filename;
        }


        Report::create([
            'name' => $request->name,
    
            'email' => $request->email,
        
            'gender' => $request->gender,
            'photo' => $photoPath,
            'repotext' => $request->repotext,
            'phone' => $request->phone,
            
            'address' => $request->address,
    
        ]);

        $notification = [
            'message' => 'reportrd  successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }

    public function AdminEditMember($id)
    {
        $types = User::findOrFail($id);
        return view('admin.edit_member', compact('types'));
    }

    public function AdminUpdateMember(Request $request)
    {
        $pid = $request->id;
        print $pid;

        User::findOrFail($pid)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
            'gender' => $request->gender,
            'photo' => $request->photo,
            'phone' => $request->phone,
            'department' => $request->department,
            'address' => $request->address,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        $notification = [
            'message' => 'Member Profile is Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }

    public function AdminDeleteMember($id)
    {
        User::findOrFail($id)->delete();

        $notification = [
            'message' => 'Member is Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()
            ->back()
            ->with($notification);
    }

    public function AdminStatusChange($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Toggle the status between active and inactive
        $user->update([
            'status' => $user->status == 'active' ? 'inactive' : 'active',
        ]);

        // Prepare a notification message
        $notification = [
            'message' => 'Member profile status updated successfully.',
            'alert-type' => 'success',
        ];

        // Redirect with notification
        return redirect()
            ->route('admin.showmember')
            ->with($notification);
    }
}