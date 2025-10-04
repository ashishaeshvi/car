<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMileage extends Model
{
    use HasFactory;

    protected $table = 'car_mileages';

    // Fillable fields for mass assignment
    protected $fillable = [
        'car_id',
        'fuel_type_id',
        'transmission',
        'mileage',
        'city_mileage',
        'highway_mileage',
    ];

    /**
     * Relationship with Car
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
}
