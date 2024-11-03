<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Event\Database\factories\EventFactory;
use Modules\Payment\Entities\Payment;
use Modules\Venue\Entities\Venue;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'name',
        'available_tickets',
        'description',
        'ticket_sales_end_date'
    ];

    /**
     * Get the venue that owns the event.
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * Get all the purchased tickets for the event.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    protected static function newFactory()
    {
        return EventFactory::new();
    }
}
