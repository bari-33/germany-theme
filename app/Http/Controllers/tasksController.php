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

    public function checkedtask($id,$order,$loop)
    {
        $data = order::where("id", $order)->get('check_boxes')->first();
        if (isset($data->check_boxes)) {
            $employ = explode(",", $data->check_boxes);
            if (!in_array($id, $employ)) {
                order::where("id", $order)->update([
                    "check_boxes" => empty($data->check_boxes) ? '' .$id : $data->check_boxes . ',' .$id
                ]);

            }
        }
        $data1 = order::where("id", $order)->get('check_boxes')->first();
        $employ = explode(",", $data1->check_boxes);
        $employee = count($employ);
        if ($loop == $employee) {
             order::where('id', $order)->update([ "order_status" => "4"]);
           $status =  order::where('id', $order)->first();
         $data = json_encode($status);
         return response($data);
        }

    }


    public function uncheck($id,$order)
    {
        $data1 = order::where('id', $order)->select('check_boxes')->first();
        $order1   =  $data1->check_boxes;
        $order_db = explode(',', $order1);
        if (($key = array_search($id, $order_db)) !== false) {
            unset($order_db[$key]);
        }
        $orderss1 = implode(',', $order_db);
        order::where('id', $order)->update(["check_boxes" => $orderss1
       , "order_status" => "3"]);

    }

    public function seen($id)
    {
        order::where('id', $id)->update([ "notification_status" => "1"]);
    }
    public function seenemp($id)
    {
        order::where('id', $id)->update([ "empnotification_status" => "1"]);
    }

    public function emloyeetask()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('tasks.employetask',compact("orders"));
    }
    public function checkedemtask($id,$order,$loop)
    {
        $data = order::where("id", $order)->get('check_box')->first();
        if (isset($data->check_box)) {
            $employ = explode(",", $data->check_box);
            if (!in_array($id, $employ)) {
                order::where("id", $order)->update([
                    "check_box" => empty($data->check_box) ? '' .$id : $data->check_box . ',' .$id
                ]);

            }
        }
        $data1 = order::where("id", $order)->get('check_box')->first();
        $employ = explode(",", $data1->check_box);
        $employee = count($employ);
        if ($loop == $employee) {
             order::where('id', $order)->update([ "order_status" => "3"]);
           $status =  order::where('id', $order)->first();
         $data = json_encode($status);
         return response($data);
        }

    }


    public function uncheckemtask($id,$order)
    {
        $data1 = order::where('id', $order)->select('check_box')->first();
        $order1   =  $data1->check_box;
        $order_db = explode(',', $order1);
        if (($key = array_search($id, $order_db)) !== false) {
            unset($order_db[$key]);
        }
        $orderss1 = implode(',', $order_db);
        order::where('id', $order)->update(["check_box" => $orderss1
       , "order_status" => "2"]);

    }

}
