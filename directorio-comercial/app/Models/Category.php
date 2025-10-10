<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_category');
    }

    public function getBusinessCountAttribute()
    {
        return $this->businesses()->count();
    }
}
