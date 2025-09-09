<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class WebsiteSetting extends Model
{
    use LogsActivity;

    protected $fillable = [
        'web_mobile_number',
        'web_email_id',
        'company_name',
        'footer_description',
        'company_address',
        'website_logo',
        'copyright_text'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'web_mobile_number',
                'web_email_id',
                'company_name',
                'footer_description',
                'company_address',
                'copyright_text',
            ])
            ->logOnlyDirty()
            ->useLogName('website_setting')
            ->setDescriptionForEvent(fn(string $eventName) => "Website setting has been {$eventName}");
    }
}
