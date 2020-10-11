<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function chat($id)
    {
        $messages = Message::where('from', $id)->orWhere('to', $id)->get();
        return response()->json($messages);
    }

    public function contacts()
    {
        $contacts = User::where('id', '!=', auth()->id())->get();
        return response()->json($contacts);
    }


    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

//        $mess = (array)$message;

        NewMessage::dispatch($request->all());

//        broadcast(new Message($mess));

        return response()->json($message);
    }
}
