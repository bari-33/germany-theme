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

class SettingController extends Controller
{
     public function EditAccount()
     {
        $user = User::where('id', Auth::user()->id)->get();
        $roles = Role::all();
        return view('user.edituser',compact('user','roles'));
     }
     public function MyAccount()
    {
        $userdetail=user::where('id',Auth::user()->id)->first();
        return view('user.show',compact('userdetail'));

    }
}
