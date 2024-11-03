<?php

namespace Modules\Event\Listeners;

use Modules\Event\Events\TicketIsPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Event\Http\Repositories\EventRepository;

class UpdateAvailableTickets
{
    private EventRepository $eventRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Handle the event.
     *
     * @param TicketIsPurchased $event
     * @return void
     */
    public function handle(TicketIsPurchased $event)
    {
        $this->eventRepository->updateEventAvailableTickets($event->event);
    }
}
