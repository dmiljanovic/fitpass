<?php

namespace Modules\Venue\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Venue\Database\factories\VenueFactory;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity'
    ];

    protected static function newFactory()
    {
        return VenueFactory::new();
    }
}
