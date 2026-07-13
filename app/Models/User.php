<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'risk',
        'gdp',
        'inflation',
        'weather',
        'port',
        'latitude',
        'longitude',
    ];
}
