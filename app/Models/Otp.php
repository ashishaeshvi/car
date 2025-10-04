<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = ['contact_number', 'otp_code', 'expires_at', 'is_used'];

    protected $dates = ['expires_at'];

    public function isExpired()
    {
        return now()->greaterThan($this->expires_at);
    }
}
