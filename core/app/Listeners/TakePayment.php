<?php

namespace App\Listeners;

use App\Events\ProcessPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TakePayment
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
     * @param  ProcessPayment  $event
     * @return void
     */
    public function handle(ProcessPayment $event)
    {
        $user=$event->user;
        $total=$event->total;

        $user->charge($total * 100);
    }
}
