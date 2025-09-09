<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AllCountry extends Model
{
    public function states(): HasMany
    {
        return $this->hasMany(AllState::class, 'country_id', 'id');
    }
}
