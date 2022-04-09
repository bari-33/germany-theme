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

    public function checkedtask($id,$order)
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
}
