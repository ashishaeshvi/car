<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RaDocument extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'ra_name',
        'ra_sign',
        'ra_stamp',
        'agency_name',
        'address',
        'status',
        'user_id',
        'scan_notary',
        'affidavit_notary',
        'letterpad_logo',
        'letterpad_footer',
        'ra_name_hindi',
        'registration_no'
    ];

    public function getAffidavitNotaryAttribute($value)
    {
        return explode(',', $value);
    }

    public function getScanNotaryAttribute($value)
    {
        return explode(',', $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly([
                'ra_name',
                'ra_sign',
                'ra_stamp',
                'agency_name',
                'address',
                'status',
                'user_id',
                'ra_name_hindi',
                'registration_no'
                ])
                ->logOnlyDirty()
                ->useLogName('ra_document')
                ->setDescriptionForEvent(fn(string $eventName) => "RA document has been {$eventName}");
    }
}
