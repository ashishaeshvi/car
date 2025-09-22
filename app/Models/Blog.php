<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Add fields allowed for mass assignment
    protected $fillable = [
        'blog_title',
        'category_id',
        'slug_uri',
        'blog_description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'blog_img', 
		'blog_thumbnail_img',        
    ];
}
