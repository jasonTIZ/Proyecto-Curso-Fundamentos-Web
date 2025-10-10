<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'order_position',
    ];

    protected $casts = [
        'order_position' => 'integer',
    ];
}
