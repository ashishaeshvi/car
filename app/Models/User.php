<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\HasMeta;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes, LogsActivity, HasMeta;

     protected $with = ['meta'];
     
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'mobile',
        'password',
        'address',
        'added_by',
        'id_proof',
        'profile_image',
        'city',
        'pincode'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'role_id', 'mobile', 'address', 'status'])
            ->logOnlyDirty()
            ->useLogName('user')
            ->setDescriptionForEvent(fn(string $eventName) => "User has been {$eventName}");
    }
}

