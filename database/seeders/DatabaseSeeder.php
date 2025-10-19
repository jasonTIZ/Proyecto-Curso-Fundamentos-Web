<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Slide;
use App\Models\Category;
use App\Models\Business;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@directorio.com',
            'password' => Hash::make('admin123'),
        ]);

        // Crear slides
        Slide::create([
            'title' => 'Descubre los Mejores Comercios',
            'description' => 'Encuentra productos y servicios de calidad en tu zona',
            'image' => 'slides/slide1.jpg',
            'link' => '/categorias',
            'order_position' => 1,
        ]);

        Slide::create([
            'title' => 'Conecta con Negocios Locales',
            'description' => 'Apoya el comercio local y descubre nuevas opciones',
            'image' => 'slides/slide2.jpg',
            'link' => '/categorias',
            'order_position' => 2,
        ]);

        // Crear categorías
        $restaurantes = Category::create([
            'name' => 'Restaurantes',
            'description' => 'Los mejores lugares para comer',
            'image' => 'categories/restaurantes.jpg',
        ]);

        $tecnologia = Category::create([
            'name' => 'Tecnología',
            'description' => 'Productos y servicios tecnológicos',
            'image' => 'categories/tecnologia.jpg',
        ]);

        $moda = Category::create([
            'name' => 'Moda y Belleza',
            'description' => 'Ropa, accesorios y servicios de belleza',
            'image' => 'categories/moda.jpg',
        ]);

        // Crear comercios
        $elSabor = Business::create([
            'name' => 'Restaurante El Sabor',
            'description' => 'Comida tradicional costarricense con los mejores ingredientes',
            'featured_image' => 'businesses/sabor.jpg',
            'address' => 'San José, Avenida Central',
            'phones' => '2222-3333, 8888-9999',
            'emails' => 'info@elsabor.com',
            'facebook' => 'https://facebook.com/elsabor',
            'instagram' => 'https://instagram.com/elsabor',
            'latitude' => 9.93333,
            'longitude' => -84.08333,
        ]);
        $elSabor->categories()->attach($restaurantes->id);

        $techStore = Business::create([
            'name' => 'TechStore CR',
            'description' => 'Computadoras, laptops y accesorios tecnológicos',
            'featured_image' => 'businesses/techstore.jpg',
            'address' => 'San José, Mall San Pedro',
            'phones' => '2255-6666, 8555-4444',
            'emails' => 'ventas@techstore.cr',
            'facebook' => 'https://facebook.com/techstore',
            'instagram' => 'https://instagram.com/techstore',
            'latitude' => 9.93333,
            'longitude' => -84.08333,
        ]);
        $techStore->categories()->attach($tecnologia->id);

        $elegancia = Business::create([
            'name' => 'Boutique Elegancia',
            'description' => 'Moda femenina de alta calidad',
            'featured_image' => 'businesses/elegancia.jpg',
            'address' => 'San José, Paseo Colón',
            'phones' => '2288-9999, 8222-1111',
            'emails' => 'ventas@elegancia.com',
            'facebook' => 'https://facebook.com/elegancia',
            'instagram' => 'https://instagram.com/elegancia',
            'latitude' => 9.93333,
            'longitude' => -84.08333,
        ]);
        $elegancia->categories()->attach($moda->id);

        // Crear productos
        Product::create([
            'business_id' => $elSabor->id,
            'name' => 'Casado Tradicional',
            'description' => 'Arroz, frijoles, carne, plátano maduro, ensalada y picadillo',
            'price' => 4500.00,
            'featured_image' => 'products/casado.jpg',
        ]);

        Product::create([
            'business_id' => $techStore->id,
            'name' => 'Laptop Dell Inspiron 15',
            'description' => 'Intel Core i5, 8GB RAM, 256GB SSD, Windows 11',
            'price' => 450000.00,
            'featured_image' => 'products/laptop-dell.jpg',
        ]);

        Product::create([
            'business_id' => $elegancia->id,
            'name' => 'Vestido Elegante',
            'description' => 'Vestido de noche en diferentes tallas y colores',
            'price' => 45000.00,
            'featured_image' => 'products/vestido.jpg',
        ]);
    }
}
