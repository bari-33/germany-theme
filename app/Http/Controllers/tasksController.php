<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class tasksController extends Controller
{
    public function tasks()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('tasks.index',compact("orders"));
    }
}
