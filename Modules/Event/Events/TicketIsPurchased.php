<?php

namespace Modules\Event\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Event\Entities\Event;

class TicketIsPurchased
{
    use SerializesModels;

    public Event $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
