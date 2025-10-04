<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarProsCons extends Model
{
    use HasFactory;

    protected $table = 'car_pros_cons';

    protected $fillable = [
        'car_id',
        'type',
        'notes_date',
    ];

    /**
     * Relationship: Eacdescriptionh gallery image belongs to a car.
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
