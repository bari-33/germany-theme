<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class MessageController extends Controller
{
     public function Message()
     {
        $users = User::orderBy('created_at', 'ASC')->get();
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];

        return view('/content/chat/app-chat', [
            'pageConfigs' => $pageConfigs
        ],compact('users'));
     }
}
