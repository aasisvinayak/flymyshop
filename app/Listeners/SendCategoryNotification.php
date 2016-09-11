<?php

namespace App\Listeners;

use App\Events\CategoryAdded;

class SendCategoryNotification
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
     * @param CategoryAdded $event
     *
     * @return void
     */
    public function handle(CategoryAdded $event)
    {
        //
    }
}
