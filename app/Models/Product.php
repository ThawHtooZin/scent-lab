<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'description',
        'price',
        'size',
        'image',
        'top_note',
        'heart_note',
        'base_note',
        'is_featured',
        'display_order',
    ];
}
