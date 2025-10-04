<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
class Brand extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['name','slug','brandImg' ,'status'];

      protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });

        static::updating(function ($brand) {
            $brand->slug = Str::slug($brand->name);
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','brandImg','status','user_id'])
                ->logOnlyDirty()
                ->useLogName('brand')
                ->setDescriptionForEvent(fn(string $eventName) => "brand has been {$eventName}");
    }
}
