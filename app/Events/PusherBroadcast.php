<?php
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->chat->receiver_id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'user_id' => $this->chat->user_id,
            'receiver_id' => $this->chat->receiver_id,
            'message' => $this->chat->message,
            'message_type' => $this->chat->message_type,
            'file_path' => $this->chat->file_path,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}
