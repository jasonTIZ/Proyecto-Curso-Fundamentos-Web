<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoriaNegocio; // Import the CategoriaNegocio model

class CategoriaNegocioImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = CategoriaNegocio::all();

        foreach ($categorias as $categoria) {
            // Generate a random image URL from Lorem Picsum
            // Using a fixed size for consistency, and a random ID to get different images
            $randomImageUrl = 'https://picsum.photos/seed/' . rand(1, 1000) . '/800/450';

            $categoria->categoria_negocio_imagen_url = $randomImageUrl;
            $categoria->save();
        }
    }
}