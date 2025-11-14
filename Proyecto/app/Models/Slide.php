<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'link'
    ];

    /**
     * Return a usable URL for the image.
     * Handles stored values that may be full URLs, '/storage/..' paths,
     * relative storage paths like 'slides/xxx.jpg' or filesystem paths.
     */
    public function getUrl()
    {
        $val = $this->image_url;
        if (!$val) return null;

        // if already full URL (http/https)
        if (preg_match('#^https?://#i', $val)) {
            return $val;
        }

        // if starts with /storage/ or storage/
        if (strpos($val, '/storage/') === 0 || strpos($val, 'storage/') === 0) {
            // ensure leading slash
            return Str::startsWith($val, '/') ? $val : ('/' . $val);
        }

        // if it's a path on the public disk (e.g. 'slides/xxx.jpg')
        if (Storage::disk('public')->exists($val)) {
            return Storage::url($val);
        }

        // fallback: return the value as-is
        return $val;
    }
}
