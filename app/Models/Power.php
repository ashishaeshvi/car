<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Power extends Model
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

        static::creating(function ($power) {
            $power->slug = Str::slug($power->name);
        });

        static::updating(function ($power) {
            $power->slug = Str::slug($power->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
