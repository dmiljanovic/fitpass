<?php

namespace Modules\Event\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'event_name' => $this->name,
            'available_tickets' => $this->available_tickets,
            'venue_name' => $this->venue->name,
            'ticket_sales_end_date' => $this->ticket_sales_end_date
        ];
    }
}
