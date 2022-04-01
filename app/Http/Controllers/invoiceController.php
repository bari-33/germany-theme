<?php

namespace App\Http\Controllers;
use App\Models\Design;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ClientDetail;
use App\Models\UserDetail;
use App\Models\Website;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    public function list_invoice()
    {
        $orders=Order::orderBy('created_at','ASC')->get();

        $ClientDetail=UserDetail::orderBy('created_at','ASC')->get();
        $users=User::orderBy('created_at','ASC')->get();

        $employees=User::whereHas('roles', function($q) {
            $q->where('id', '2');
        })->get();
        Session::put('all',$orders->count());
        Session::put('progress',Order::where('order_status','2')->orderBy('created_at','ASC')->count());
        Session::put('waiting',Order::where('order_status','1')->orderBy('created_at','ASC')->count());
        Session::put('completed',Order::where('order_status','3')->orderBy('created_at','ASC')->count());
        Session::put('cancelled',Order::where('order_status','-1')->orderBy('created_at','ASC')->count());
        Session::put('deleted',Order::onlyTrashed()->count());



        return view('invoices.list_invoice',compact('orders','ClientDetail','users'));
    }
}
