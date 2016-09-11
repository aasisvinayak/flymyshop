<?php

namespace App\Events;

use App\Http\Models\Category;
use Illuminate\Queue\SerializesModels;

class CategoryAdded extends Event
{
    use SerializesModels;
    public $category;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
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
