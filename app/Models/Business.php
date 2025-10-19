<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'name',
        'description',
        'featured_image',
        'address',
        'phones',
        'emails',
        'facebook',
        'instagram',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'business_category');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function gallery()
    {
        return $this->hasMany(BusinessGallery::class);
    }

    public function getPhonesArrayAttribute()
    {
        return $this->phones ? explode(',', $this->phones) : [];
    }

    public function getEmailsArrayAttribute()
    {
        return $this->emails ? explode(',', $this->emails) : [];
    }
}
