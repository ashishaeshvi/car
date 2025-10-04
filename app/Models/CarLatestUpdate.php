<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarLatestUpdate extends Model
{
    use HasFactory;

    protected $table = 'car_latest_updates';

    protected $fillable = [
        'car_id',
        'notes',
        'notes_date',
    ];

    /**
     * Relationship: Each gallery image belongs to a car.
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
