<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }


    protected function authenticated(Request $request, $user) {
        if ($user->roles()->first()->slug == 'admin') {
            return redirect('dashboard');
        } else if ($user->roles()->first()->slug == 'customer' ) {
            return redirect('customer_dashboard');
        }
        else if ($user->roles()->first()->slug == 'employee' ) {
            return redirect('employ_dashboard');
        }
        else {
            return redirect('/login');
        }
    }
}

