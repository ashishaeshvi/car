<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AdsBanner extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','adsImg','position' ,'status'];

    

}
