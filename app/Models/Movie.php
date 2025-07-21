<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'year',
        'rated',
        'released',
        'runtime',
        'genre',
        'director',
        'writer',
        'actors',
        'plot',
        'language',
        'country',
        'awards',
        'poster',
        'ratings',
        'metascore',
        'imdb_rating',
        'imdb_votes',
        'imdb_id',
        'type',
        'dvd',
        'box_office',
        'production',
        'website',
    ];

    protected $casts = [
        'ratings' => 'array',
    ];
}
