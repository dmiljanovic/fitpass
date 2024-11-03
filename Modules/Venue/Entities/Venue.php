<?php

namespace Modules\Venue\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'capacity'
    ];

    protected static function newFactory()
    {
        return \Modules\Venue\Database\factories\VenueFactory::new();
    }
}
