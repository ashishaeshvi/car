<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Colour extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','user_id' ,'status','slug'];


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
}
