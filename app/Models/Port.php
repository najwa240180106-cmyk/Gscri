<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Country;

class Port extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'status',
        'capacity',
        'risk',
        'latitude',
        'longitude',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}