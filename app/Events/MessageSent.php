<?php
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast {
    public $message;

    public function __construct($message) {
        $this->message = $message;
    }

    public function broadcastOn() {
        return new PrivateChannel('chat.' . $this->message->receiver_id);
    }

    public function broadcastWith() {
        return [
            'message' => $this->message,
        ];
    }
}
