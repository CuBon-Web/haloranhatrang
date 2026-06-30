<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table = 'itineraries';

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'content',
        'map_image',
        'featured_image',
        'days',
        'sort',
        'status',
    ];

    protected $casts = [
        'days' => 'array',
    ];
}
