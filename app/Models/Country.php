<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = [
        'name',
        'country_code',
        'currency',
        'region',
        'risk',
        'gdp',
        'inflation',
        'weather',
        'port',
        'latitude',
        'longitude',
        'score',
    ];

    public function ports(): HasMany
    {
        return $this->hasMany(Port::class);
    }
}