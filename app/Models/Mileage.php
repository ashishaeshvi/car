<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Mileage extends Model
{
    use HasFactory, SoftDeletes;

     protected $fillable = ['name','user_id' ,'status' ,  'slug' ];

      protected static function boot()
    {
        parent::boot();

        static::creating(function ($mileage) {
            $mileage->slug = Str::slug($mileage->name);
        });

        static::updating(function ($mileage) {
            $mileage->slug = Str::slug($mileage->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
