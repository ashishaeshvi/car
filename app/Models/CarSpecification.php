<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'fuel_type', 'transmission', 'engine_cc',
        'mileage', 'seating_capacity', 'color'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
