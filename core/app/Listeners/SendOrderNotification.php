<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $order_id;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPlaced  $event
     * @return void
     */
    public function handle(OrderPlaced $event)
    {
        $this->order_id = $event->order->order_no;
        Mail::queue(
            [],
            [],
            function ($message) {
                $message->from(env('MAIL_FROM'));
                $message->to(env('MAIL_TO'));
                $message->subject('Order Placed');
                $message->setBody('Order id '.$this->order_id);
            }
        );
    }
}
