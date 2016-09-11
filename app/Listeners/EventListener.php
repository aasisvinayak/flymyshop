<?php

namespace App\Listeners;

use App\Events\SomeEvent;

class EventListener
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
     * @param SomeEvent $event
     *
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        //
    }
}
