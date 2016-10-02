<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class ProcessPayment extends Event
{
    use SerializesModels;
    public $user;
    public $total;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $total)
    {
        $this->user = $user;
        $this->total = $total;
      //  $user->charge($total * 100);
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
