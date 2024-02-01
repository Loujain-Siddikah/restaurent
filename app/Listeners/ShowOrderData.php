<?php

namespace App\Listeners;

use App\Events\MealOrdered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowOrderData
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MealOrdered  $event
     * @return void
     */
    public function handle(MealOrdered $event)
    {
        $order = $event->order;
    }
}
