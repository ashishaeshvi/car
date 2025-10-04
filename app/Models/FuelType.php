<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class FuelType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'status',
        'user_id',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($fuelType) {
            $fuelType->slug = Str::slug($fuelType->name);
        });

        static::updating(function ($fuelType) {
            $fuelType->slug = Str::slug($fuelType->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
