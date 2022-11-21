<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{


    public function Dashboard(){
        return view('admin.admin_master');
    }

    //admin profile
    public function index()
    {
        $data = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('data'));
    }

    //admin Profile Update
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'mobile' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,'.Auth::user()->id.',id',
        ]);

        $formData = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
        ];
        $data = User::find(Auth::user()->id);
        $data->update($formData);

        $request->session()->flash('successMessage', $data->name."'s account was successfully updated!");
        return redirect()->route('profile');
    }

    //end funcation

    //password
    public function password()
    {
        $data = User::find(Auth::user()->id);
        return view('admin.admin_profile', compact('data'))->with('password', 1);
    }
    //end funcation

    //update password
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|max:20|min:8|confirmed',
        ]);

        $data = User::find(Auth::user()->id);

        if (!Hash::check($request->current_password, $data->password)) {
            $request->session()->flash('errorMessage', "The specified password does not match the database password");
        } else {
            $formData = [
                'password' => Hash::make($request->password),
            ];
            $data->update($formData);

            $request->session()->flash('successMessage', $data->name."'s password was successfully updated!");
        }

        return redirect()->route('profile');
    }
    //end funcation



    //LogOut funcation
    public function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//end funcation
}
