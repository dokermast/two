<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Illuminate\Support\Facades\Log;

//Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});


Broadcast::channel('chat', function ($user, $room_id) {

//    Log::info((int) $user->id === (int) $room_id );
//    return (int) $user->id === (int) $room_id;
    return true;

//    if($user->rooms->contains($room_id)){
//        return $user->name;
//    }

});
