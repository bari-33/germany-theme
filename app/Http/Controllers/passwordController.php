<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeProduct;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class passwordController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get();
        return view('passwords.index',compact('user'));
    }

    public function chngpassword(request $request ,$id)
    {
        $request->validate([

            'password' => 'required|confirmed|min:8',
        ]);
        // $password = Hash::make($request->get('oldPassword'));
        if (!Hash::check($request->get('oldPassword'), Auth::user()->password)) {
           return redirect()->back()->with('alert', 'password does not match');
        }
        $password = Hash::make($request->get('password'));
        user::where("id", $id)->update([
            "password"=>$password
        ]);


        return redirect()->back()->with('success', 'password Changed successfully');

    }
}
