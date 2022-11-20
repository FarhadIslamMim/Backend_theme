<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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



    //LogOut funcation
    public function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }//end funcation
}
