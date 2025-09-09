<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UserPassport extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'passport_no',
        'candidate_sign',
        'candidate_photo',
        'ra_document_id',
        'fe_sign_id',
        'fe_stamp_id',
        'sponsor_name',
        'sponsor_id',
        'fe_name',
        'fe_no',
        'fe_age',
        'fe_phone_no',
        'pobox',
        'pin_code',
        'job',
        'vacancy',
        'salary',
        'all_country_id',
        'individual_or_company',
        'user_id',
        'passport',
        'visa',
        'ref_no',
        'status',
    ];

    public function user() :BelongsTo {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function raDocument() :BelongsTo {
        return $this->belongsTo(RaDocument::class);
    }

    public function feSign() :BelongsTo {
        return $this->belongsTo(FeDocument::class , 'fe_sign_id', 'id')->select('id', 'name', 'attachment');
    }

    public function feStamp() :BelongsTo {
        return $this->belongsTo(FeDocument::class, 'fe_stamp_id', 'id')->select('id', 'name', 'attachment');
    }

    public function country(): BelongsTo {
        return $this->belongsTo(AllCountry::class, 'all_country_id', 'id')->select('id', 'name', 'phonecode', 'capital');
    }

    protected static function booted(){
        static::deleting(function ($passport) {
            $passport->candidate()->delete();
        });
    }

    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class, 'user_passport_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly([
                'passport_no',
                'candidate_sign',
                'candidate_photo',
                'ra_document_id',
                'fe_sign_id',
                'fe_stamp_id',
                'sponsor_name',
                'sponsor_id',
                'fe_name',
                'fe_no',
                'fe_age',
                'fe_phone_no',
                'pobox',
                'pin_code',
                'job',
                'vacancy',
                'salary',
                'all_country_id',
                'individual_or_company',
                'user_id',
                'ref_no',
                'status'
                ])
                ->logOnlyDirty()
                ->useLogName('user_document')
                ->setDescriptionForEvent(fn(string $eventName) => "User Passport has been {$eventName}");
    }
}
