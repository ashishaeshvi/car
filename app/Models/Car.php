<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'dealer_id', 'brand','car_id' ,'car_name', 'variant', 'price',
        'manufacture_year', 'registration_year', 'car_condition',
        'insurance_doc', 'ownership', 'rto', 'car_image','description','rc_copy','insurance_doc','pollution','image_360','gallery_image','features'
    ];

    // Relationships
    public function dealer()
    {
        return $this->belongsTo(User::class, 'dealer_id')->where('role_id', 4);
    }

    public function specifications()
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function features()
    {
        return $this->belongsToMany(CarFeature::class);
    }
}
