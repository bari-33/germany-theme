<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRequest;
use App\Events\NewMessage;
use App\Models\Message;
use App\Models\Messenger;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;


require __DIR__ . '/../../../vendor/autoload.php';
class chatController extends Controller
{
    public function read(Request $request)
    {
        $message = Messenger::where('to', $request->to)->update(['read'=>'1']);
        $message = Messenger::where('from', $request->to)->update(['read'=>'1']);
        return response()->json($message);
    }
    public function getall($id)
    {

        $messages=Messenger::where(function($q) use($id){
            $q->where('from',auth()->id());
            $q->where('to',$id);
        })->orWhere(function($q) use ($id){
            $q->where('from',$id);
            $q->where('to',auth()->id());
        })->with('fromContact')->orderBy('created_at','asc')->get();


        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message=Messenger::create([
            'from'=>auth()->user()->id,
            'to'=>$request->to,
            'messages'=>$request->message,
        ]);


        $pusher = new Pusher("d7767093b596500eb0a2", "4ed36e55f41fd3e5dff0", "917955", array('cluster' => 'mt1'));

        if(empty($request->to) && Auth::user()->roles()->first()->slug=='customer') {
            if(!(ChatRequest::where('from',$request->from)->exists())){
            $chat_request =new ChatRequest();
            $chat_request->from=$request->from;
            $chat_request->order=$request->orderid;
            $chat_request->profile_picture=$request->profile_picture;
            $chat_request->name=$request->name;
            $chat_request->save();

            $pusher->trigger('my-channel-request', 'my-event', array('message' => $request->message, 'profile_picture' => $request->profile_picture, 'name' => $request->name, 'from' => $request->from,'order' => $request->orderid));
        }}
        else{
            $pusher->trigger('my-channel'.$request->to, 'my-event', array('message' => $request->message, 'profile_picture' => $request->profile_picture, 'name' => $request->name,'id'=>$message->id, 'from' => $request->from));

        }

        // broadcast(new NewMessage($message));
        return response()->json($message);
    }
    public function readreceipt(Request $request)
    {
        $message=Messenger::find($request->id);
        $message->read=1;
        $message->save();
        return response()->json('success');
    }

    public function Message()
    {
        $employees=User::whereHas('roles', function($q) {
            $q->where('id', '2');
        })->get();
        $chat = Messenger::orderBy('created_at', 'ASC')->get();
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];

        return view('/content/chat/app-chat', [
            'pageConfigs' => $pageConfigs
        ],compact('employees','chat'));
    }
}
