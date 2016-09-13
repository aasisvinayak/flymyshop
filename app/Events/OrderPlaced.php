<?php

namespace App\Events;

use App\Http\Models\Invoice;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Event
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Invoice $order)
    {
        $this->order = $order;
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
