<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarGallery extends Model
{
    use HasFactory;

    protected $table = 'car_galleries';

    protected $fillable = [
        'car_id',
        'image',
    ];

    /**
     * Relationship: Each gallery image belongs to a car.
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
