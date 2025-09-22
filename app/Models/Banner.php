<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Banner extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['user_id','bannerImg' ,'status'];

    

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['bannerImg','status','user_id'])
                ->logOnlyDirty()
                ->useLogName('banner')
                ->setDescriptionForEvent(fn(string $eventName) => "banner has been {$eventName}");
    }
}
