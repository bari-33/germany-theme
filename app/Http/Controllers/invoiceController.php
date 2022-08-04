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
        $ClientDetail=ClientDetail::orderBy('created_at','ASC')->get();
        //  $ClientDetail = User::orderBy('created_at', 'ASC')->with('userdetail')->get();
        // dd($ClientDetail);
        $employees=User::whereHas('roles', function($q) {
            $q->where('id', '2');
        })->get();
        Session::put('all',$orders->count());
        Session::put('progress',Order::where('order_status','2')->orderBy('created_at','ASC')->count());
        Session::put('waiting',Order::where('order_status','3')->orderBy('created_at','ASC')->count());
        Session::put('completed',Order::where('order_status','4')->orderBy('created_at','ASC')->count());
        Session::put('cancelled',Order::where('order_status','1')->orderBy('created_at','ASC')->count());
        Session::put('deleted',Order::onlyTrashed()->count());
        return view('invoices.list_invoice',compact('orders','ClientDetail'));
    }
     public function invoices($id)
     {
        $order=Order::find($id);
		$user=User::where('id',$order->customer_id)->with('userdetail')->first();
        $product=Product::find($order->product_id);
        $design=Design::find($order->design_id);
        $website=Website::find($order->website_id);


        $total_price_without_tax=(float)str_replace(',','.',$order->total_price);
        $tax=$total_price_without_tax*0.19;
        $total_price=$total_price_without_tax+$tax;

        $total_price=str_replace('.',',',number_format($total_price, 2));
        $tax=str_replace('.',',',number_format($tax, 2));
        $total_price_without_tax=str_replace('.',',',number_format($total_price_without_tax, 2));

        $items=[
            'product_name'=>$product->product_title,
            'product_price'=>$product->regular_price,
            'product_language'=>$product->language,
            'design_name'=>$design->design_title,
            'design_category'=>$design->product_category,
            'design_price'=>$design->regular_price,
            'website_name'=>$website->website_title,
            'website_category'=>$website->product_category,
            'website_price'=>$website->regular_price,
            'tax'=>$tax,
            'price'=>$total_price_without_tax,
            'total_price'=>$total_price,
            'express'=>$order->express,
            'order_created_at'=>$order->created_at,
            'order_completion_date'=>$order->completion_date,
            'order_id'=>$order->id,
            'order_status'=>$order->order_status,
            'user_name'=>$user->name,
            'email'=>$user->email,
            'mobile'=>$order->user->clientdetail->mobile,
            'street_no'=>$order->user->clientdetail->street_no,
            'house_no'=>$order->user->clientdetail->house_no,
            'zip_code'=>$order->user->clientdetail->zip_code,
            'city'=>$order->user->clientdetail->city,
        ];
        return view('invoices.newshow',compact('items'));
     }


     public function search(Request $request)
     {
        $ClientDetail=ClientDetail::orderBy('created_at','ASC')->get();
        if($request->input('action')!='custom_date'){
            $trash=false;
            switch ($request->input('action'))
            {

                case 'all':
                    $orders=Order::orderBy('created_at','ASC')->get();
                    break;
                case 'progress':

                    $orders=Order::where('order_status','2')->orderBy('created_at','ASC')->get();
                    break;
                case 'waiting':
                    $orders=Order::where('order_status','3')->orderBy('created_at','ASC')->get();
                    break;
                case 'completed':
                    $orders=Order::where('order_status','4')->orderBy('created_at','ASC')->get();
                    break;
                case 'cancelled':
                    $orders=Order::where('order_status','1')->orderBy('created_at','ASC')->get();
                    break;
                case 'deleted':
                    $orders=Order::onlyTrashed()->get();
                    $trash=true;
                    break;


            }
        }else{
             $trash=true;
             // dd($request);
            $orders=Order::whereBetween('created_at', [$request->date_from." 00:00:00", $request->date_to." 23:59:59"])->orderBy('created_at','ASC')->get();
        }


            return view('invoices.list_invoice',compact('orders','trash','ClientDetail'));


     }

    //  public function deleteallInvoices(request $request)
    //  {
    //      $selector = $request->selector;
    //      dd($request->all());
    //      if ($selector != 0) {
    //          foreach ($selector as  $value) {
    //              Order::where('id', $value)->delete();
    //          }
    //      }

    //      return redirect('list_order');
    //  }
}
