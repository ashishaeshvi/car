<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllState extends Model
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(AllCountry::class, 'country_id', 'id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(AllCity::class, 'state_id', 'id');
    }
}
