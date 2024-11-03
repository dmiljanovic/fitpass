<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Event\Entities\Event;

class Payment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ticket_purchases';

    protected $fillable = [
        'event_id',
        'email',
        'transaction_id'
    ];

    /**
     * Get the venue associated with the event.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
