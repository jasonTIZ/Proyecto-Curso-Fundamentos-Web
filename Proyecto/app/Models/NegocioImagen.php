<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NegocioImagen extends Model
{
    protected $table = 'negocio_imagen';
    protected $primaryKey = 'id_imagen_negocio';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio', 'url_imagen'
    ];

    /**
     * Return a usable URL for the image.
     * Handles stored values that may be full URLs, '/storage/..' paths,
     * relative storage paths like 'negocios/xxx.jpg' or filesystem paths.
     */
    public function getUrl()
    {
        $val = $this->url_imagen;
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

        // if it's a path on the public disk (e.g. 'negocios/xxx.jpg')
        if (Storage::disk('public')->exists($val)) {
            return Storage::url($val);
        }

        // if it's a full filesystem path, try to extract the file name and look in public disk
        $basename = basename($val);
        $candidates = [
            'negocios/' . $basename,
            $basename,
        ];
        foreach ($candidates as $cand) {
            if (Storage::disk('public')->exists($cand)) {
                return Storage::url($cand);
            }
        }

        // fallback: return the value as-is
        return $val;
    }
}
