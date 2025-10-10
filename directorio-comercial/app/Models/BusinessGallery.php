<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessGallery extends Model
{
    protected $table = 'business_gallery';

    public $timestamps = false;

    protected $fillable = [
        'business_id',
        'image',
        'caption',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
