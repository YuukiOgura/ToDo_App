<?php

namespace App\Events;

// use App\Library\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //public $user;
    public $message;
    public $otherUserId;
    /**
     * Create a new event instance.
     *
     * @param $user       // メッセージを送信したユーザー
     * @param $message    // 送信されたメッセージ
     * @param $otherUserId // メッセージの受信者のユーザーID
     */
    public function __construct($user, $message, $otherUserId)
    {
        //$this->user = $user;
        
        $this->message = $message;
        $this->otherUserId = $otherUserId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastOn(): array
    {
        $channelName = 'ToDo_Portfolio.' . $this->otherUserId;

        return [
            new PrivateChannel($channelName)
        ];
    }
    /*  return [
            new PrivateChannel( 'ToDo_Portfolio.'.$this->otherUserId)
        ]; */
}
