<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarSpecification extends Model
{
    use HasFactory;

    protected $fillable = ['car_id','body_type','brand','fuel_type','transmission','engine_cc','mileage','seating_capacity','colour','safety_ratings','airbags','torque_id','power_id'];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
