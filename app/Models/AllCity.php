<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllCity extends Model
{
    public function state(): BelongsTo
    {
        return $this->belongsTo(AllState::class, 'state_id', 'id');
    }
}
