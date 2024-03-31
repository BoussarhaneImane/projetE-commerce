<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\User;
use Illuminate\Http\Request;

class messageController extends Controller
{
    // TODO: Get messages
    public function getMessage($id){
        $user = User::find($id);
        $messages = message::query()->where('id_sender', $id)->orWhere('id_receiver', $id)->get();
        return [
            "user" => $user,
            "messages" => $messages
        ];
    }
    // TODO: Post message
    public function postMessage(Request $request){
        $message = message::create([
            "messageText" => $request->messageText,
            "id_sender" => $request->user()->id,
            "id_receiver" => $request->id_receiver
        ]);
        return response()->json($message);
    }
}
