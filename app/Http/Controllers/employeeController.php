<?php

namespace App\Http\Controllers;
use App\Models\Design;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function emporders()
    {
        $user=User::find(Auth::user()->id);
        $orders = Order::orderBy('created_at', 'ASC')->get();
        return view('employees.orders',compact('orders','user'));
    }
    public function empbill()
    {
        $user=User::find(Auth::user()->id);
        $orders = Order::orderBy('created_at', 'ASC')->get();
        return view('employees.invoice',compact('orders','user'));
    }
}
