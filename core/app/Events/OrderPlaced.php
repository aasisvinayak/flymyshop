<?php

namespace App\Events;

use App\Http\Models\Invoice;
use Illuminate\Queue\SerializesModels;

/**
 * Class OrderPlaced
 * Called when can order is placed - See check_out()
 *
 * @package App\Events
 */
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
