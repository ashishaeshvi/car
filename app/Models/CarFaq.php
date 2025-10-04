<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFaq extends Model
{
    use HasFactory;

    protected $table = 'car_faqs';

    // Fillable fields for mass assignment
    protected $fillable = [
        'car_id',
        'section',   // e.g., Price, Performance
        'question',
        'answer',
    ];

    /**
     * Relationship with Car
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
