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
use App\Models\ReferenceCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
// use PDF;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Knp\Snappy\Pdf;

class AdminOrderController extends Controller
{
    public function list_order()
    {
        $orders = Order::orderBy('orders.created_at', 'ASC')
        ->join('users','users.id','=','orders.customer_id')
        ->select('orders.*','users.name as name')
        ->get();
        // dd($orders);
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->get();
        $dropdown = User::where("status", "1")->get();
        Session::put('all', $orders->count());
        Session::put('progress', Order::where('order_status', '2')->orderBy('created_at', 'Desc')->count());
        Session::put('waiting', Order::where('order_status', '3')->orderBy('created_at', 'Desc')->count());
        Session::put('completed', Order::where('order_status', '4')->orderBy('created_at', 'Desc')->count());
        Session::put('cancelled', Order::where('order_status', '1')->orderBy('created_at', 'Desc')->count());
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
                    $orders = Order::orderBy('created_at', 'ASC')->get();
                    break;
                case 'progress':

                    $orders = Order::where('order_status', '2')->orderBy('created_at', 'ASC')->get();
                    break;
                case 'waiting':
                    $orders = Order::where('order_status', '3')->orderBy('created_at', 'ASC')->get();
                    break;
                case 'completed':
                    $orders = Order::where('order_status', '4')->orderBy('created_at', 'ASC')->get();
                    break;
                case 'cancelled':
                    $orders = Order::where('order_status', '1')->orderBy('created_at', 'ASC')->get();
                    break;
                case 'deleted':
                    $orders = Order::onlyTrashed()->get();
                    $trash = true;
                    break;
            }
        } else {
            $trash = true;
            // dd($request);
            $orders = Order::whereBetween('created_at', [$request->date_from . " 00:00:00", $request->date_to . " 23:59:59"])->orderBy('created_at', 'ASC')->get();
        }


        return view('orders.list_order', compact('orders', 'trash', 'dropdown', 'employees'));
    }
    public function dropupdate($id,$order)
    {
        $status = "1";
        $order_id_in_db = User::where("id", $id)->get('order_id')->first();
        if (isset($order_id_in_db->order_id)) {
            $ind_order_id = explode(",", $order_id_in_db->order_id);
            if (!in_array($order, $ind_order_id)) {

                 User::where("id", $id)->update([
                    "status" => $status,
                    "order_id" => empty($order_id_in_db->order_id) ? '' . $order : $order_id_in_db->order_id . ',' . $order
                ]);

            }
        }
        $order_status = "2";
        $data = order::where("id", $order)->get('user_id')->first();
        if (isset($data->user_id)) {
            $employ = explode(",", $data->user_id);
            if (!in_array($id, $employ)) {
                order::where("id", $order)->update([
                    "order_status"=>  $order_status,
                    "user_id" => empty($data->user_id) ? '' . $id : $data->user_id . ',' . $id
                ]);

            }
        }

      $suertable =   User::where("id", $id)->first();
      $data = json_encode($suertable);
      return response($data);
    }
    public function unassingemploy($id,$order_id)
    {
        $data = User::where('id', $id)->select('order_id')->first();
        $order   =  $data->order_id;
        $order_id_db = explode(',', $order);
        if (($key = array_search($order_id, $order_id_db)) !== false) {
            unset($order_id_db[$key]);
        }
        $orderss = implode(',', $order_id_db);
        user::where('id', $id)->update(["order_id" => $orderss]);

        $data1 = order::where('id', $order_id)->select('user_id')->first();
        $order1   =  $data1->user_id;
        $order_db = explode(',', $order1);
        if (($key = array_search($id, $order_db)) !== false) {
            unset($order_db[$key]);
        }
        $orderss1 = implode(',', $order_db);
        order::where('id', $order_id)->update(["user_id" => $orderss1,
        //  "order_status"=>$order_status,
         ]);
       $check_order_id_for_Status =  order::where('id', $order_id)->select('user_id')->first();
         if($check_order_id_for_Status->user_id != "")
         {
            $order_status = "2";
         }
         else
         {
            $order_status = "0";
         }
         order::where('id', $order_id)->update(["order_status"=>$order_status]);
         $userss = User::where("id", $id)->first();
         $data = json_encode($userss);
         return response($data);

    }
    public function running($order)
    {
        $order = Order::find($order);
        $order->order_status = '2';
        $order->payment_status = '0';
        $order->save();
        $data = json_encode($order);
        return response($data);
    }

    public function check($order)
    {
        $order = Order::find($order);
        $order->order_status = '3';
        $order->payment_status = '0';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function finished($order)
    {
        $order = Order::find($order);
        $order->order_status = '4';
        $order->payment_status = '0';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function activated($order)
    {
        $order = Order::find($order);
        $order->order_status = '-1';
        $order->payment_status = '0';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function cancelled($order)
    {
        $order = Order::find($order);
        $order->order_status = '1';
        $order->payment_status = '-1';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }

    public function todo($order)
    {
        $order = Order::find($order);
        $order->order_status = '0';
        $order->payment_status = '0';
        $order->save();
          $data = json_encode($order);
        return response($data);
    }
    public function deleteorder($id)
    {
         Order::where('id', $id)->delete();
        return redirect('list_order');
    }
    public function editorder($id)
    {
        $employees = User::whereHas('roles', function ($q) {
            $q->where('id', '2');
        })->whereDoesntHave('employee_orders', function ($q) use ($id) {
            $q->where('order_id', $id);
        })->get();
        $order = Order::find($id);
        $user = User::find($order->customer_id);
        $product = Product::find($order->product_id);
        $design = Design::find($order->design_id);
        $website = Website::find($order->website_id);
        $vat['complete_application'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $product->regular_price) * 0.19), 2));
        $vat['application_homepage'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $website->regular_price) * 0.19), 2));
        $vat['design'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $design->regular_price) * 0.19), 2));
        $vat['express_processing'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $order->express) * 0.19), 2));
        $vat['total'] = str_replace('.', ',', number_format(((float)str_replace(',', '.', $order->total_price) * 0.19), 2));
        $vat['product_price'] = $product->regular_price;
        $vat['website_price'] = $product->regular_price;
        $vat['design_price'] = $product->regular_price;
        return view('orders.edit_order', compact('order', 'employees', 'vat'));
    }
    public function trialDocuments(Request $request, $id)
    {
        $order = Order::find($id);

        $document = $request->file('trialdocuments');
        $documentName = $document->getClientOriginalName();
        $document->move(public_path('files/trialdocuments'), $documentName);

        $documents = new TrialDocument();
        $documents->name = $documentName;
        $documents->order_id = $id;
        $documents->save();
           return redirect()->back();
        // return response()->json(['success' => $documentName]);
    }
    public function invoicepdf($id)
    {
        $order=Order::find($id);
        $user=User::find($order->customer_id);
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
            'user_name'=>$order->user->name,
            'email'=>$order->user->email,
            'mobile' => $order->user->userdetail->mobile,
            'street_no'=>$order->user->userdetail->street_no,
            'house_no'=>$order->user->userdetail->house_no,
            'zip_code'=>$order->user->userdetail->zip_code,
            'city'=>$order->user->userdetail->city,

        ];
        $timestemp = date("Y-m-d H:i:s");
        $year = Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->month;
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $year = substr($year, -2);
        $date = $year. "-" .$month;
        // $checker = ReferenceCount::exists();
        // if (!$checker){
        //     $refercen_no = "RE-".$year.$month."-1000";
        //     $InsertRefernceCount = new ReferenceCount();
        //     $InsertRefernceCount->refer_type = 'Invoice';
        //     $InsertRefernceCount->date = $date;
        //     $InsertRefernceCount->reference_num = $refercen_no;
        //     $InsertRefernceCount->save();
        // } else {
        //     $saveDate =  ReferenceCount::latest()->first();
        //     if($date == $saveDate->date)
        //     {
        //         // $refercen_no = "RE-".$year.$month."-1000";
        //         $refercen_no = $saveDate->reference_num;
        //         $numArr = explode('-', $refercen_no);
        //         $newnum = 1 + intval($numArr[2]);
        //         $refercen_no = "RE-".$year.$month.'-'.$newnum;
        //         $affectedRows = ReferenceCount::where("date", $date)->update([
        //         "reference_num" => $refercen_no
        //         ]);
        //     }
        //     else{
        //         $refercen_no = "RE-".$year.$month."-1000";
        //         $InsertRefernceCount = new ReferenceCount();
        //         $InsertRefernceCount->refer_type = 'Invoice';
        //         $InsertRefernceCount->date = $date;
        //         $InsertRefernceCount->reference_num = $refercen_no;
        //         $InsertRefernceCount->save();
        //     }

        // }

        $refercen_num =  ReferenceCount::latest()->first();
        // dd($refercen_num->reference_num);
        return view('orders.dowenlode', compact('items','refercen_num'));

    }
    public function deleteall(request $request)
    {
        $selector = $request->selector;
        if ($selector != 0) {
            foreach ($selector as  $value) {
                Order::where('id', $value)->delete();
            }
        }

        return redirect('list_order');
    }
    public function paid(request $request)
    {
        $payment_status = "1";
        $selector = $request->selector;
        $selector = $request->selector;
        foreach ($selector as  $value) {
            Order::where('id', $value)->update(["payment_status" => $payment_status]);
        }
        return redirect('list_order');
    }
    public function restore(request $request)
    {
        $selector = $request->selector;
        foreach ($selector as  $value) {
            order::where('id', $value)->withTrashed()->restore();
        }
        return redirect('list_order');

    }
    public function allinvoice(request $request)
    {
        $selector = $request->selector;
        $invoice = [];
        $path = public_path('myfiles/');

        if (is_dir($path)) {
            File::deleteDirectory($path);
        }
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($selector as  $value) {
            $order = Order::find($value);

            $user = User::find($order->customer_id);
            $product = Product::find($order->product_id);
            $design = Design::find($order->design_id);
            $website = Website::find($order->website_id);
            $total_price_without_tax = (float)str_replace(',', '.', $order->total_price);
            $tax = $total_price_without_tax * 0.19;
            $total_price = $total_price_without_tax + $tax;

            $total_price = str_replace('.', ',', number_format($total_price, 2));
            $tax = str_replace('.', ',', number_format($tax, 2));
            $total_price_without_tax = str_replace('.', ',', number_format($total_price_without_tax, 2));

            $items = [
                'product_name' => $product->product_title,
                'product_price' => $product->regular_price,
                'product_language' => $product->language,
                'design_name' => $design->design_title,
                'design_category' => $design->product_category,
                'design_price' => $design->regular_price,
                'website_name' => $website->website_title,
                'website_category' => $website->product_category,
                'website_price' => $website->regular_price,
                'tax' => $tax,
                'price' => $total_price_without_tax,
                'total_price' => $total_price,
                'express' => $order->express,
                'order_created_at' => $order->created_at,
                'order_completion_date' => $order->completion_date,
                'order_id' => $order->id,
                'order_status' => $order->order_status,
                'user_name' => $order->user->name,
                'email' => $order->user->email,
                'mobile' => $order->user->userdetail->mobile,
                'street_no' => $order->user->userdetail->street_no,
                'house_no' => $order->user->userdetail->house_no,
                'zip_code' => $order->user->userdetail->zip_code,
                'city' => $order->user->userdetail->city,

            ];

            array_push($invoice, $items);

        }

        foreach ($invoice as  $items) {

            $timestemp = date("Y-m-d H:i:s");
            $year = Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
            $month = Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->month;
            $month = str_pad($month, 2, '0', STR_PAD_LEFT);
            $year = substr($year, -2);
            $date = $year. "-" .$month;
            $checker = ReferenceCount::exists();
            if (!$checker){
                $refercen_no = "RE-".$year.$month."-1000";
                $InsertRefernceCount = new ReferenceCount();
                $InsertRefernceCount->refer_type = 'Invoice';
                $InsertRefernceCount->date = $date;
                $InsertRefernceCount->reference_num = $refercen_no;
                $InsertRefernceCount->save();
            } else {
                $saveDate =  ReferenceCount::latest()->first();
                if($date == $saveDate->date)
                {

                    $refercen_no = $saveDate->reference_num;
                    $numArr = explode('-', $refercen_no);
                    $newnum = 1 + intval($numArr[2]);
                    $refercen_no = "RE-".$year.$month.'-'.$newnum;
                    $affectedRows = ReferenceCount::where("date", $date)->update([
                    "reference_num" => $refercen_no
                    ]);
                }
                else{
                    $refercen_no = "RE-".$year.$month."-1000";
                    $InsertRefernceCount = new ReferenceCount();
                    $InsertRefernceCount->refer_type = 'Invoice';
                    $InsertRefernceCount->date = $date;
                    $InsertRefernceCount->reference_num = $refercen_no;
                    $InsertRefernceCount->save();
                }
            }

                $refercen_num =  ReferenceCount::latest()->first();
                $html = view('orders.alldownload', compact('items','path','refercen_num'))->render();

            }
// dd($invoice);
        $zip = new ZipArchive;
        $zipfile = public_path('invoice.zip');
        if (File::exists(public_path('invoice.zip'))) {
            unlink(public_path('invoice.zip'));
        }

        $fileName = 'invoice.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('myfiles'));
            foreach ($files as $key => $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }


         return response()->download(public_path($fileName));
    }

    public function updateorder(Request $request, $id)
    {
        $order = Order::find($id);
        //changing order status
        $order->order_status = $request->get('order_status');

        $order->save();

        // fetching data for products designs and websites
        $product = Product::find($order->product_id);
        $design = Design::find($order->design_id);
        $website = Website::find($order->website_id);

        $product_price = (float)str_replace(',', '.', $product->regular_price);
        $design_price = (float)str_replace(',', '.', $design->regular_price);
        $website_price = (float)str_replace(',', '.', $website->regular_price);
        $express_price = (float)$order->express;
        $total_price = $product_price + $design_price + $website_price + $express_price;
        $tax = $total_price * 0.19;

        $account_data = [
            'user' => $order->user->name,
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
            'finishing_date' => Carbon::parse($order->completion_date)->format('M d Y'),
        ];


        if ($request->get('order_status') == "2") {
            // Mail::to($order->user->email)->send(new OrderProcessing($account_data));
        }

        if ($request->get('order_status') == "3") {
            // Mail::to($order->user->email)->send(new OrderWaitingPayment($account_data));
        }

        if ($request->get('order_status') == "4") {
            // Mail::to($order->user->email)->send(new OrderCompleted($account_data));
        }

        if ($request->get('order_status') == "-1") {
            // Mail::to($order->user->email)->send(new OrderCancelled($account_data));
        }
        if ($request->get('order_status') == "-2") {
            // Mail::to($order->user->email)->send(new OrderRefunded($account_data));
        }

        return redirect('list_order');
    }


    public function deleteTrialDocument($id)
    {

        $document = TrialDocument::find($id);
        $path = public_path() . '/files/trialdocuments/' . $document->name;
        if (file_exists($path)) {
            unlink($path);
        }

        $document->delete();

        // return response($id);
    }
    public function finisheddocuments(Request $request, $id)
    {
        $order = Order::find($id);

        $document = $request->file('finisheddocuments');
        $documentName = $document->getClientOriginalName();
        $document->move(public_path('files/finisheddocuments'), $documentName);

        $documents = new FinishedDocument();
        $documents->name = $documentName;
        $documents->order_id = $id;
        $documents->save();
        return redirect()->back();
    }

    public function deleteFinishedDocument($id)
    {
        $document = FinishedDocument::find($id);
        $path = public_path() . '/files/finisheddocuments/' . $document->name;
        if (file_exists($path)) {
            unlink($path);
        }

        $document->delete();

        // return response($id);
    }

    public function saveNotes(Request $request,$id)
    {
        $order = Order::find($id);

        $order->orderdetail()->update([
            "notes" => $request->get('notes'),
        ]);
        return redirect('list_order');

    }
}
