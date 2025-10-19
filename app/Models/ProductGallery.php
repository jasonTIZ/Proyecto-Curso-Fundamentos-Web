<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    protected $table = 'product_gallery';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'image',
        'caption',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
