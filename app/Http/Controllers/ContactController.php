<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function chat($id)
    {
        $messages = Message::where('from', $id)->orWhere('to', $id)->get();

        $chat_id = $this->getChatId($id);
        $data = ['messages' => $messages, 'chat_id' => $chat_id];

//        return response()->json($messages);
        return response()->json($data);
    }

    public function contacts()
    {
        $contacts = User::where('id', '!=', auth()->id())->get();
        return response()->json($contacts);
    }


    public function send(Request $request)
    {
        $user_from = auth()->user();
        $chats_from = $user_from->chats;
        $user_to = User::find($request->contact_id);
        $chats_to = $user_to->chats;

        $chat_id = null;
        foreach ($chats_from as $chat){
            if ($chats_to->contains($chat)){
                $chat_id = $chat->id;
            }
        }

        if(!$chat_id){
            $chat = new Chat();
            $chat->save();
            $chat_id = $chat->id;
            $user_from->chats()->attach($chat);
            $user_to->chats()->attach($chat);
        }

        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        $request->merge(['chat_id' => $chat_id]);

        NewMessage::dispatch($request->all());

        
        $data = ['message' => $message, 'chat_id' => $chat_id];

//        broadcast(new Message($mess));

//        return response()->json($message);
        return response()->json($data);
    }


    public function getChatId($user_to_id)
    {
        $user_from = auth()->user();
        $chats_from = $user_from->chats;
        $user_to = User::find($user_to_id);
        $chats_to = $user_to->chats;

        $chat_id = null;
        foreach ($chats_from as $chat){
            if ($chats_to->contains($chat)){
                $chat_id = $chat->id;
            }
        }

        if(!$chat_id){
            $chat = new Chat();
            $chat->save();
            $chat_id = $chat->id;
            $user_from->chats()->attach($chat);
            $user_to->chats()->attach($chat);
        }

        return $chat_id;
    }


//    public function foo()
//    {
//        $user_from = auth()->user();
//        $chats_from = $user_from->chats;
//        $user_to = User::find(2);
//        $chats_to = $user_to->chats;
//
//        $chat_id = null;
//        foreach ($chats_from as $chat){
//            if ($chats_to->contains($chat)){
//                $chat_id = $chat->id;
//            }
//        }
//        if(!$chat_id){
//            $chat = new Chat();
//            $chat->save();
//            $chat_id = $chat->id;
//            $user_from->chats()->attach($chat);
//            $user_to->chats()->attach($chat);
//        }
//        dump($chat_id);
//
//        $intersection = collect([
//            $chats_f,
//            $chats_to
//        ])->reduce(function ($carry, $item) {
//            return $carry->empty() ? $item : $carry->intersect($item);
//        });
//    }
}
