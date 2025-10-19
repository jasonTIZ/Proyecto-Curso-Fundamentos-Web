<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'featured_image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }
}
