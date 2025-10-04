<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class EngineCapacity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'user_id',
        'slug'
    ];



      protected static function boot()
    {
        parent::boot();

        static::creating(function ($engineCapacity) {
            $engineCapacity->slug = Str::slug($engineCapacity->name);
        });

        static::updating(function ($engineCapacity) {
            $engineCapacity->slug = Str::slug($engineCapacity->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
