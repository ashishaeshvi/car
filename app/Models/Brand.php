<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Brand extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['name','brandImg' ,'status'];

    

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','brandImg','status','user_id'])
                ->logOnlyDirty()
                ->useLogName('brand')
                ->setDescriptionForEvent(fn(string $eventName) => "brand has been {$eventName}");
    }
}
