<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MealOrdered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $order;
    public function __construct($order)
    {
        $this->order = $order;

    }

    /**
     * Get the channels the event should broadcast on.
     * define broadcast channel
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('order');
        // return new PrivateChannel('App.Models.User.' . $this->data['user_id']);

    }
    
    public function broadcastWith()
    {
        return [
            'order' => $this->order,
            // 'userName' => $this->order->user->first_name,
        ];
    }
}
