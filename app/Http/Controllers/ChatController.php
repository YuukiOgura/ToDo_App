<?php

namespace App\Http\Controllers;

use App\Library\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        return view('chat/chat');
    }
    
    //メッセージ送信時の処理
    public function sendMessage( Request $request)
    {
        // 認証済みユーザーの取得
        $user = Auth::user();
        $strUsername = $user->name;
        // リクエストからデータの取り出し
        $strMessage = $request->input('message');

        // Messageオブジェクトのインスタンス化
        $message = new Message;
        $message->username = $strUsername;
        $message->body = $strMessage;

        // 送信者を含めてメッセージを送信
        MessageSent::dispatch($message);

        /* 送信者を除いてメッセージを送信 
        use Illuminage\Broadcasting\InteractsWithSockets
        broadcast( new MessageSent($message))->toOthers();
        return ['message' => $strMessage];
        */

        return $request;

        //チャットページから送られてきたチャットメッセージをMessageSentイベントを通してPusherに送信。
    }
}
