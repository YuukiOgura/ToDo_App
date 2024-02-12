<?php

namespace App\Http\Controllers;

use App\Library\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\ChatRecipient;
use App\Models\User;
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
        // チャットページレイアウト用コントローラー
        $user = Auth::user();
        $user_id = Auth::id();
        $userAll = User::all();
        $userId = Auth::id();
        $otherUsers = [];

        //「ログインしているユーザー」以外の情報を取得
        foreach ($userAll as $other) {
            if ($userId !== $other->id) {
                $otherUsers[] = $other;
            }
        }
        // Chatモデルのリレーションシップを利用して、送信者の情報と、受信者のユーザー情報を取得する。
        $allMessages = Chat::with('user', 'recipients.user')
        /* 
        送信者として条件を指定。
        Chatモデルカラムのuser_idが、認証済みユーザーである条件を指定する。 
        */
        ->where('user_id', $user_id)
        /* 
        受信者として条件を指定。
        orWhereHasメソッドを使用し、recipientsメソッド（受信者）の中で、認証済みユーザーIDがあるカラムを取得。
        */
        ->orWhereHas('recipients', function ($recipientQuery) use ($user_id) {
            $recipientQuery->where('user_id', $user_id);
        })
        // 取得した情報を昇順に並べ替え。
        ->orderBy('created_at', 'asc')
        ->get();

        return view('chat/chat', compact('user', 'otherUsers', 'allMessages','user_id'));
    }

    //メッセージ送信時の処理
    public function sendMessage(Request $request)
    {
        /* Pusherへのデータ送信と登録 */
        // 認証済みユーザーの取得
        $user = Auth::user();
        // リクエストからデータの取り出し
        $strMessage = $request->input('message');
        // 受信者のユーザーID
        $otherUserId = $request->input('other_id');
        // 送信者ID
        $sender_id = Auth::id();


        // Messageオブジェクトのインスタンス化
        //（use App\Library\Message; モデルではなく、メッセージの整形の為のファイル）
        $message = new Message;
        //$message->username = $strUsername;
        $message->sender_id = $sender_id;
        $message->body = $strMessage;

        // 送信者を含めてメッセージを送信
        // dispatchメソッドは非同期処理のイベントを発火させるために使用します。
        MessageSent::dispatch($user, $message, $otherUserId);

        /* 送信者を除いてメッセージを送信 
        use Illuminage\Broadcasting\InteractsWithSockets
        broadcast( new MessageSent($message))->toOthers();
        return ['message' => $strMessage];
        */

        /* 
        DBにメッセージを保存。
        Chatテーブルには送信者のIDを登録する。
        ChatRecipientテーブルには受信者のIDを登録する。
        */

        $chat = new Chat();
        $chat->message = $request->input('message');
        $chat->user_id = $sender_id;
        $chat->save();

        $chatRecipients = new ChatRecipient();
        $chatRecipients->user_id = $otherUserId;
        $chat->recipients()->save($chatRecipients);

        return $request;
    }
}
