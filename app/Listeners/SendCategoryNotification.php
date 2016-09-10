<?php

namespace App\Listeners;

use App\Events\CategoryAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  CategoryAdded  $event
     * @return void
     */
    public function handle(CategoryAdded $event)
    {
        //
    }
}
