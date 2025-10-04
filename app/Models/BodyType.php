<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class BodyType extends Model
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

        static::creating(function ($bodyType) {
            $bodyType->slug = Str::slug($bodyType->name);
        });

        static::updating(function ($bodyType) {
            $bodyType->slug = Str::slug($bodyType->name);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
