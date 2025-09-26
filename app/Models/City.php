<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class City extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['name','user_id' ,'status'];

    

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','status','user_id'])
                ->logOnlyDirty()
                ->useLogName('City')
                ->setDescriptionForEvent(fn(string $eventName) => "City has been {$eventName}");
    }
}