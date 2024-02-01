<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewOrder extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // via() method that specifies the channel 
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // The returned array will be stored in the data column of notifications table after being encoded as JSON.
    public function toDatabase($notifiable)
    {
        return [
            'order'=> $this->order,
            'title'=>'den yeni sipariş geldi',
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage{
        return new BroadcastMessage([
            'order' => $this->order,
            'userFirstName' => $this->order->user->first_name,
            'userLastName' => $this->order->user->last_name,
            'title'=>'den yeni sipariş geldi',
        ]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

}
