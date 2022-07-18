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
use App\Models\ChatRequest;
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
  public function employ_dashboard()
  {
    //   echo '<pre>'; print_r("here"); echo '</pre>'; die;
    $products=Product::all()->count();
    $designs=Design::all()->count();
    $websites=Website::all()->count();
    $orders1 = Order::orderBy('created_at', 'ASC')->get();
    $orders=User::find(Auth::user()->id)->employee_orders()->orderBy('created_at','ASC')->get();
    $employee=User::find(Auth::user()->id);
        foreach ($orders1 as $key => $order) {
            $data = explode(',', $order->user_id);
        foreach ($data as $key => $value) {
            if ($value==$employee->id) {
                $order_count=$order->count();
                // echo '<pre>'; print_r($order_count); echo '</pre>'; die;
                $previous_month_orders=$orders1->where('order_user.created_at',Carbon::now()->subMonth()->month)->count();
                $current_month_orders=$orders1->where('order_user.created_at',Carbon::now()->month)->count();
            }
        }
        }
    $order_count=$orders->count();

    $previous_month_orders=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->subMonth()->month)->count();
    $current_month_orders=$employee->employee_orders()->whereMonth('order_user.created_at',Carbon::now()->month)->count();

 if($previous_month_orders==$current_month_orders){
            $order_p = 0;
        }else{
        if($current_month_orders==0){
            $order_p = -100;
        }else{
            if($previous_month_orders > $current_month_orders){
            $order_p = -1 * (($current_month_orders * 100) / $previous_month_orders);
            }else{
                $order_p = ($previous_month_orders * 100) / $current_month_orders;
            }

        }
    }


    if($previous_month_orders==0)
    {
        $previous_month_orders=1;
    }
    $order_count_percentage=((int)$current_month_orders-(int)$previous_month_orders)/$previous_month_orders;


    $revenue=$orders1->where('order_user.created_at',Carbon::now()->month)->sum('amount');

    $previous_revenue=$orders1->where('order_user.created_at',Carbon::now()->subMonth()->month)->sum('amount');

    if($revenue==$previous_revenue){
        $order_r = 0;
    }else{
    if($revenue==0){
        $order_r = -100;
    }else{
        if($previous_revenue > $revenue){
        $order_r = -1 * (($revenue * 100) / $previous_revenue);
        }else{
            $order_r = ($previous_revenue * 100) / $revenue;
        }

    }
    }



    if($previous_revenue==0)
    {
        $previous_revenue=1;
    }
   $percentage=((int)$revenue-(int)$previous_revenue)/$previous_revenue;


    $unreadIds = Messenger::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
        ->where('to', auth()->id())
        ->where('read', false)
        ->groupBy('from')
        ->get();
       $contacts = $orders->map(function($contact) use ($unreadIds) {
        $contactUnread = $unreadIds->where('sender_id', $contact->user->id)->first();
        $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
        return $contact;
    });

    $contacts=collect();
    $orders=Order::where('employee_chat',Auth::user()->id)->get();
    // foreach ($orders as $order)
    // dd( $order);

    // {
    //     $user=$order->user;

    //     $count=Messenger::where('from',$user->id)->where('to',Auth::user()->id)->where('read','0')->count();
    //     $user->setAttribute('count',$count);
    //     $contacts->add($user);

    // }


    $admin=Role::where('slug','admin')->first()->users()->first();
    $count=Messenger::where('from',$admin->id)->where('to',Auth::user()->id)->where('read','0')->count();

    $chat_requests=ChatRequest::where('accepted','0')->get();

    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs],compact('orders1','products','designs','websites','orders','order_count','employee','percentage','revenue','contacts','admin','count','chat_requests','order_count_percentage','order_p','order_r'));
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
    $customers=User::whereHas('roles', function($q) {
        $q->where('id', '3');
    })->count();
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
    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs],compact('products','dropdown','employees','designs','websites','orders','orders_count','revenue','employees','customers','order_p','order_r','prod_p','cdaily_avg','pdaily_avg','avg_p'));
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
