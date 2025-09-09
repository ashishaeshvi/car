<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Candidate extends Model
{
   use SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_passport_id',
        'visa_no',
        'en_visa_no',
        'visa_issue_date',
        'visa_expiry_date',
        'job_on_visa',
        'visa_issue_place',
        'passport_no',
        'first_name_eng',
        'last_name_eng',
        'name_hindi',
        'dob',
        'birth_place',
        'passport_issue_place',
        'passport_issue_date',
        'passport_expiry_date',
        'passport_issue_state',
        'current_city',
        'passport_address',
        'passport_pin_code',
        'father_name',
        'nominee_relation',
        'nominee_name',
        'candidate_mobile_no',
        'alternate_no',
        'pobox',
        'pin_code',
        'emigrate_fe_id',
        'user_id',
        'status',
    ];

    public function setVisaIssueDateAttribute($value)
    {
        $this->attributes['visa_issue_date'] = $value ? convertDateFormat($value) : null;
    }

    public function setVisaExpiryDateAttribute($value)
    {
        $this->attributes['visa_expiry_date'] = $value ? convertDateFormat($value) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? convertDateFormat($value) : null;
    }

    public function setPassportIssueDateAttribute($value)
    {
        $this->attributes['passport_issue_date'] = $value ? convertDateFormat($value) : null;
    }

    public function setPassportExpiryDateAttribute($value) {
        $this->attributes['passport_expiry_date'] = $value ? convertDateFormat($value) : null;
    }

    // Accessors for date fields using convertDateFormat
    public function getVisaIssueDateAttribute($value)
    {
        return $value ? convertDateFormat($value, 'Y-m-d', 'd-m-Y') : null;
    }

    public function getVisaExpiryDateAttribute($value)
    {
        return $value ? convertDateFormat($value, 'Y-m-d', 'd-m-Y') : null;
    }

    public function getDobAttribute($value)
    {
        return $value ? convertDateFormat($value, 'Y-m-d', 'd-m-Y') : null;
    }

    public function getPassportIssueDateAttribute($value)
    {
        return $value ? convertDateFormat($value, 'Y-m-d', 'd-m-Y') : null;
    }

    public function getPassportExpiryDateAttribute($value)
    {
        return $value ? convertDateFormat($value, 'Y-m-d', 'd-m-Y') : null;
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name_eng} {$this->last_name_eng}");
    }

    public function user() :BelongsTo {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function getFilledByAttribute()
    {
        return $this->user->name ?? '';
    }

    public function passportDetail(): BelongsTo {
        return $this->belongsTo(UserPassport::class, 'user_passport_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                ->logOnly([
                'visa_no',
                'visa_issue_date',
                'visa_expiry_date',
                'job_on_visa',
                'visa_issue_place',
                'first_name_eng',
                'last_name_eng',
                'name_hindi',
                'dob',
                'birth_place',
                'passport_issue_place',
                'passport_issue_date',
                'passport_expiry_date',
                'passport_issue_state',
                'current_city',
                'passport_address',
                'passport_pin_code',
                'father_name',
                'nominee_relation',
                'nominee_name',
                'candidate_mobile_no',
                'alternate_no',
                'pobox',
                'pin_code',
                'emigrate_fe_id',
                'user_id',
                'status'])
                ->logOnlyDirty()
                ->useLogName('candidate')
                ->setDescriptionForEvent(fn(string $eventName) => "Candidate has been {$eventName}");
    }
}
