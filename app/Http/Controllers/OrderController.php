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

class OrderController extends Controller
{
    public function add_order()
    {
        $products = Product::all();
        return view('orders.index', compact('products'));
    }
    public function create($id)
    {
        $product = Product::find($id);
        $designs = Design::all();
        $websites = Website::all();
        $design_categories = DesignCategory::all();
        $website_categories = WebsiteCategory::all();

        return view('orders.show', compact('designs', 'websites', 'product', 'design_categories', 'website_categories'));
    }

    public function store1(Request $request)
    {
        $password = rand(1000, 9999);

        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'nickname' => 'required',
            'phonenumber' => 'required',
            'gender' => 'required',
        ]);


        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($password),
        ]);


        $order = new Order();
        $order->product_id = $request->get('product');
        $order->design_id = $request->get('design');
        $order->website_id = $request->get('website');

        $order->express = str_replace('.', ',', number_format($request->get('express'), 2));;

        if ($request->get('express') == '0') {
            $order->completion_date = Carbon::now()->addDay(4);
        } else {
            $order->completion_date = Carbon::now()->addDay(1);
        }


        $order->order_status = '0';
        $order->payment_status = '0';
        $order->customer_id = $user->id;

        // fetching data for products designs and websites
        $product = Product::find($request->get('product'));
        $design = Design::find($request->get('design'));
        $website = Website::find($request->get('website'));

        // calulating total price for an order
        $product_price = (float)str_replace(',', '.', $product->regular_price);
        $design_price = (float)str_replace(',', '.', $design->regular_price);
        $website_price = (float)str_replace(',', '.', $website->regular_price);
        $express_price = (float)$request->get('express');
        $total_price = $product_price + $design_price + $website_price + $express_price;

        $order->total_price = str_replace('.', ',', number_format($total_price, 2));
        $order->total_exact_price = $total_price;
        $order->save();
        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->save();
        $tax = $total_price * 0.19;
        $account_data = [
            'user' => $order->user->name,
            'email' => $user->email,
            'password' => $password,
            'order_id' => $order->id,
            'product_name' => $product->product_title,
            'product_price' => $product->regular_price,
            'product_language' => $product->language,
            'design_name' => $design->design_title,
            'design_category' => $design->product_category,
            'design_price' => $design->regular_price,
            'website_name' => $website->website_title,
            'website_category' => $website->product_category,
            'website_price' => $website->regular_price,
            'total_price' => $order->total_price,
            'express' => $express_price,
            'date' => Carbon::parse($order->created_at->toDateString())->format('M d Y'),
            'tax' => $tax,
            'finishing_date' => Carbon::parse($order->completion_date->toDateString())->format('M d Y'),
        ];

        $user->roles()->attach(3);

        UserDetail::create([
            'username' => $request->get('nickname'),
            'user_id' => $user->id,
            'first_name' => $request->get('name'),
            'last_name' => $request->get('nickname'),
            'gender' => $request->get('gender'),
            'telephone' => $request->get('phonenumber'),
        ]);
        ClientDetail::create([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'first_name' => $request->get('name'),
            'last_name' => $request->get('nickname'),
            'gender' => $request->get('gender'),
            'mobile' => $request->get('phonenumber'),
        ]);
        // Mail::to($user->email)->send(new OrderMail($account_data));
        // Mail::to(Role::where('slug','admin')->first()->users()->first()->email)->send(new OrderAdmin($account_data));
        Auth::login($user);
        return view('orders.thanks', compact('password', 'order'));
    }
    public function current()
    {
        $data = Auth::user()->orders;

        foreach ($data as $key => $value) {
            $order = Order::find($value->id);
            $messages = Messenger::where('to', Auth::user()->id)->orWhere('from', Auth::user()->id)->orderBy('created_at', 'asc')->get();
            $product = Product::find($value->product_id);
            $design = Design::find($value->design_id);
            $website = Website::find($value->website_id);
            $secret = 'b3d328f07199b1d0df8d783333badf79';
            $sig = hash_hmac('sha256', Auth::user()->email, $secret);
            $tax = str_replace(".", ",", number_format(((float)str_replace(",", ".", $value->total_price) * 0.19), 2));
        }
        return view('orders.current_order', compact('order', 'product', 'design', 'website', 'sig', 'tax', 'messages'));
    }
    public function express($id)
    {
        $order = Order::find($id);
        $order->express = '59,00';
        $order->total_price = str_replace('.', ',', (float)(str_replace(',', '.', $order->total_price)) + (59.00));
        $order->completion_date = Carbon::now()->addDay(1);

        $order->save();
    }


    public function documents(request $request, $id)
    {
        $order = Order::find($id);
        $count = $order->where('id', $id)->count();

        if ($count == 0) {
            $order_progress = new OrderProgress();
            // echo '<pre>';
            // print_r($order_progress);
            // echo '</pre>';
            // die;
            $order_progress->name = 'documents';
            $order_progress->type = 'completed';
            $order_progress->order_id = $order->id;
            $order_progress->save();
        }

        $image = $request->file('documents');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('files/document'), $imageName);

        $documents = new OrderDocument();
        $documents->name = $imageName;
        $documents->order_id = $id;
        $documents->save();
        return redirect()->back();
    }

    public function deledocuments($id)
    {
        $document = OrderDocument::find($id);
        $document->delete();
        return redirect()->back();
    }

    public function payment($id)
    {
        $order = Order::find($id);
        $paypal = new Paypal();
        $paypal->payment_id = $_GET['paymentId'];
        $paypal->payer_id = $_GET['PayerID'];
        $paypal->token = $_GET['token'];
        $paypal->order_id = $order->id;
        $paypal->save();
        $order->payment_status = '1';
        $count = $order->where('id', $id)->whereHas('orderprogress', function ($q) {
            $q->where('name', '=', 'payment');
        })->count();
        if ($count == 0) {
            $order_progress = new OrderProgress();
            $order_progress->order_id = $order->id;
            $order_progress->name = 'payment';
            $order_progress->type = 'completed';

            $order_progress->save();
        }

        $order->save();
        $faqs = faq::where('set_public', '1')->get();
        return view('orders.thanks_for_payment', compact('order', 'faqs'));
    }
     public function customerOrders()
     {
      $customer =  Auth::user()->id;
      $customer=User::find($customer);
      $orders=$customer->orders;
      $secret='b3d328f07199b1d0df8d783333badf79';
      $sig = hash_hmac('sha256', Auth::user()->email, $secret);
      return view('orders.customer_orders',compact('orders','sig'));
     }

     public function getTrialDocuments($id)
     {

        $order=Order::find($id);
        $trialdocuments=$order->trialdocuments;

         return Response($trialdocuments);
     }
     public function getFinishedDocuments($id)
     {
        $order=Order::find($id);
        $finisheddocuments=$order->finisheddocuments;

        return Response($finisheddocuments);

     }
}
