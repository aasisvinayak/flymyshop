<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

/**
 * Class OrderShipped
 * Event when order status is updated to shipped.
 *
 * TODO: send notification email
 */
class OrderShipped extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
