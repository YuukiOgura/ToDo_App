<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('ToDo_Portfolio.{userId}', function ($user, $userId) {
    // ユーザーが認証されている場合、そのユーザーのIDがAuth::id()と一致するか確認します。
    return (int) $user->id === (int) $userId;
});

/* //チャンネルの接続が、認証済みユーザーの場合、ブロードキャストを許可する。
Broadcast::channel('ToDo_Portfolio.{recipientId}', function ($user, $recipientId) {
    return auth()->user();
}); */
