<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CriminalRecord;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class policeController extends Controller
{

    
    public function policeDashboard(){
        return view('police.index');
    }

    public function policeLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
    public function policeLogin(){
        return view('login');
    }

    public function policeProfile(){
        $id = Auth::user()->id;
        $profileData =User::find($id);

        return view('police.police_profile_view' ,compact('profileData'));

    }

    public function policeProfileStore(Request $request){
        $id = Auth::user()->id;
        $data =User::find($id);
        $data->username =$request->username;
        $data->name =$request->name;
        $data->email =$request->email;
        $data->phone =$request->phone;
        $data->address =$request->address;

        if($request->file('photo')){
            $file =$request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename =date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data['photo']=$filename;
        }

        $data ->save();

        $notification =array(
            'message'=>'investigation_leader profile Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);

    }

    public function policeChangePassword(){
        $id = Auth::user()->id;
        $profileData =User::find($id);
        return view('police.police_change_password',compact('profileData'));
    }

    public function policeUpdatePassword(Request $request){

        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification =array(
                'message'=>'Old Password does not match',
                'alert-type'=>'error'
            );
            return back()->with($notification);
    
        }
        User::whereId(auth()->user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        $notification =array(
            'message'=>'Password Change Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);

        
    }

    public function Policeshowrecordedcriminal()
    {
        $types = CriminalRecord::latest()->get();
        return view('police.showrecordedcriminal', compact('types'));
    }

    public function Policeshowrecordedcriminalfamily()
    {
        $types = CriminalRecord::latest()->get();
        return view('police.showrecordedcriminalfamily', compact('types'));
    }
    public function Policeshowrecordedcriminaldetail()
    {
        $types = CriminalRecord::latest()->get();
        return view('police.showrecordedcriminaldetail', compact('types'));
    }


    //
}