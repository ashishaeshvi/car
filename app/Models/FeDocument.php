<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FeDocument extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['name','type', 'attachment', 'status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly(['name','type','status','user_id'])
                ->logOnlyDirty()
                ->useLogName('fe_document')
                ->setDescriptionForEvent(fn(string $eventName) => "Fe document has been {$eventName}");
    }
}
