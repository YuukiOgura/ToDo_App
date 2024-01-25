<?php

namespace App\Http\Controllers;

use App\Library\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\ChatRecipient;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    }
    // */
    public function index()
    {
        // 認証済みユーザーのIDを取得
        $user = Auth::user();
        $userId = Auth::id();
        $userName = Auth::user()->name;

        // 認証済みユーザーに関連するメッセージを取得
        $messages = Chat::where('user_id', $userId)->orderBy('created_at')->get();

        
        return view('chat/chat', compact('messages','userName','user'));
    }

    //メッセージ送信時の処理
    public function sendMessage(Request $request)
    {
        // 認証済みユーザーの取得
        $user = Auth::user();
        // $user_id = Auth::id();
        // $strUsername = $user->name;
        // リクエストからデータの取り出し
        $strMessage = $request->input('message');
        // 受信者のユーザーID
        $otherUserId = $request->input('other_id');
        // 送信者ID
        $sender_id = Auth::id();


        // Messageオブジェクトのインスタンス化
        $message = new Message;
        //$message->username = $strUsername;
        $message->sender_id = $sender_id;
        $message->body = $strMessage; 

        // 送信者を含めてメッセージを送信
        // dispatchメソッドは非同期処理のイベントを発火させるために使用します。
        MessageSent::dispatch($user,$message,$otherUserId);

        /* 送信者を除いてメッセージを送信 
        use Illuminage\Broadcasting\InteractsWithSockets
        broadcast( new MessageSent($message))->toOthers();
        return ['message' => $strMessage];
        */

        // DBにメッセージを保存。

        /* $chat = new Chat();
        $chat->message = $request->input('message');
        $chat->user_id = $user_id;
        $chat->save();

        $chatRecipients = new ChatRecipient();
        $chatRecipients->user_id = $user_id;
        $chatRecipients->chat_id = $chat->id;
        $chatRecipients->save(); */

        return $request;
    }
}
