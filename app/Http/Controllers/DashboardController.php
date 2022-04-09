<?php

namespace App\Http\Controllers;
use App\Models\ClientDetail;
use App\Models\Design;
use App\Models\DesignCategory;
use App\Models\faq;
use App\Mail\AccountMail;
use App\Mail\OrderAdmin;
use App\Mail\OrderMail;
use App\Models\Messenger;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDocument;
use App\Models\OrderProgress;
use App\Models\Paypal;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Website;
use App\Models\WebsiteCategory;
use Carbon\Carbon;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function admindashboard()
  {
    $products=Product::all()->count();
    $designs=Design::all()->count();
    $websites=Website::all()->count();
    $orders=Order::orderBy('created_at','ASC')->get();
    $employees=User::whereHas('roles', function($q) {
        $q->where('id', '2');
    })->get();
    $dropdown=User::where("status","1")->get();

    $cm = date('Y-m');
    $pm = date('Y-m', strtotime(date('Y-m')." -1 month"));

    $cfrom = date($cm.'-01 00:00:00');
    $cto = date($cm.'-31 23:59:59');

    $pfrom = date($pm.'-01 00:00:00');
    $pto = date($pm.'-31 23:59:59');


    $corders = Order::whereBetween('created_at', [$cfrom, $cto])->count();
    $porders = Order::whereBetween('created_at', [$pfrom, $pto])->count();


    if($porders==$corders){
        $order_p = 0;
    }else{
    if($corders==0){
        $order_p = -100;
    }else{
        if($porders > $corders){
        $order_p = -1 * (($corders * 100) / $porders);
        }else{
            $order_p = ($porders * 100) / $corders;
        }

    }
    }

    $cordersrev = Order::whereBetween('created_at', [$cfrom, $cto])->get();
    $pordersrev = Order::whereBetween('created_at', [$pfrom, $pto])->get();

    $crev = 0;
    foreach($cordersrev as $co){
        $crev+=(int)$co->total_exact_price;
    }

    $prev = 0;
    foreach($pordersrev as $po){
        $prev+=(int)$po->total_exact_price;
    }


    if($crev==$prev){
        $order_r = 0;
    }else{
    if($crev==0){
        $order_r = -100;
    }else{
        if($prev > $crev){
        $order_r = -1 * (($crev * 100) / $prev);
        }else{
            $order_r = ($prev * 100) / $crev;
        }

    }
    }

    $days = date('d');
    $cdaily_avg = $crev / $days;
    $pdaily_avg = $prev / $days;
    $avg_p = 0;
    if($cdaily_avg==$pdaily_avg){
        $avg_p = 0;
    }else{
    if($cdaily_avg==0){
        $avg_p = -100;
    }else{
        if($pdaily_avg > $cdaily_avg){
        $avg_p = -1 * (($cdaily_avg * 100) / $pdaily_avg);
        }else{
            $avg_p = ($pdaily_avg * 100) / $cdaily_avg;
        }

    }
    }

    $cprod = Product::whereBetween('created_at', [$cfrom, $cto])->count();
    $pprod = Product::whereBetween('created_at', [$pfrom, $pto])->count();


    if($cprod==$pprod){
        $prod_p = 0;
    }else{
    if($cprod==0){
        $prod_p = -100;
    }else{
        if($pprod > $cprod){
        $prod_p = -1 * (($cprod * 100) / $pprod);
        }else{
            $prod_p = ($pprod * 100) / $cprod;
        }

    }
    }

    $revenue=0;
    foreach($orders as $order)
    {
        $revenue+=(int)$order->total_exact_price;
    }

    $orders_count=Order::all()->count();

    $employees=collect();
    $emp=Role::where('slug','employee')->first()->users()->get();
    foreach ($emp as $employee)
    {
        $count=Messenger::where('from',$employee->id)->where('to',Auth::user()->id)->where('read','0')->count();
        $employee->setAttribute('count',$count);
        $employees->add($employee);
    }
    $pageConfigs = ['pageHeader' => false];
    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs],compact('products','dropdown','employees','designs','websites','orders','orders_count','revenue','employees','order_p','order_r','prod_p','cdaily_avg','pdaily_avg','avg_p'));
  }
  public function customerdashboard()
  {
    $user=User::find(Auth::user()->id);
    $order=$user->orders()->count();
    $orders=$user->orders()->orderBy('created_at','desc')->get();
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/customer', ['pageConfigs' => $pageConfigs],compact('order','orders'));
  }
}
