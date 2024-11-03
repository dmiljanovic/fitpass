<?php

namespace Modules\Event\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\Event\Entities\Event;

class EventRepository
{
    public function getAllEvents(): Collection
    {
        return Event::all();
    }

    public function getEventById(int $id): Event
    {
        return Event::find($id);
    }

    public function updateEventAvailableTickets(Event $event): void
    {
        $event->available_tickets -= 1;

        $event->save();
    }
}
