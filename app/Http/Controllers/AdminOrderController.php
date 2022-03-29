<?php

namespace App\Http\Controllers;
use PDF1;
use ZipArchive;
use File;
use App\Models\Design;
use App\Models\FinishedDocument;
use App\Mail\OrderCancelled;
use App\Mail\OrderCompleted;
use App\Mail\OrderMail;
use App\Mail\OrderProcessing;
use App\Mail\OrderRefunded;
use App\Mail\OrderWaitingPayment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\TrialDocument;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function list_order()
    {
        $orders = Order::orderBy('created_at', 'ASC')->get();
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->get();
        $dropdown = User::where("status", "1")->get();
        Session::put('all', $orders->count());
        Session::put('progress', Order::where('order_status', '2')->orderBy('created_at', 'Desc')->count());
        Session::put('waiting', Order::where('order_status', '1')->orderBy('created_at', 'Desc')->count());
        Session::put('completed', Order::where('order_status', '3')->orderBy('created_at', 'Desc')->count());
        Session::put('cancelled', Order::where('order_status', '-1')->orderBy('created_at', 'Desc')->count());
        Session::put('deleted', Order::onlyTrashed()->count());
        return view('orders.list_order', compact('orders', 'dropdown', 'employees'));
    }
    public function search(request $request)
    {
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->get();
        $dropdown = User::where("status", "1")->get();
        if ($request->input('action') != 'custom_date') {
            $trash = false;


            switch ($request->input('action')) {

                case 'all':
                    $orders = Order::orderBy('created_at', 'Desc')->get();
                    break;
                case 'progress':

                    $orders = Order::where('order_status', '2')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'waiting':
                    $orders = Order::where('order_status', '1')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'completed':
                    $orders = Order::where('order_status', '4')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'cancelled':
                    $orders = Order::where('order_status', '-1')->orderBy('created_at', 'Desc')->get();
                    break;
                case 'deleted':
                    $orders = Order::onlyTrashed()->get();
                    $trash = true;
                    break;
            }
        } else {
            $trash = true;
            // dd($request);
            $orders = Order::whereBetween('created_at', [$request->date_from . " 00:00:00", $request->date_to . " 23:59:59"])->orderBy('created_at', 'Desc')->get();
        }


        // return view('adminorders.index', compact('orders', 'trash', 'dropdown', 'employees'));
    }
    public function ordersdetail()
    {
        # code...
    }
}
