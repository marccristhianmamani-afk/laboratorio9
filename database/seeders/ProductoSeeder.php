<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::truncate();

        $productos = [
            [
                'nombre' => 'Audifono JBL',
                'marca' => 'JBL',
                'precio' => 149.90,
                'stock' => 25,
                'id_categoria' => 1, // Electrónica / Informática
                'foto' => 'jbl audifono.jpg'
            ],
            [
                'nombre' => 'Laptop Lenovo',
                'marca' => 'Lenovo',
                'precio' => 2899.00,
                'stock' => 10,
                'id_categoria' => 1, // Electrónica / Informática
                'foto' => 'laptoplenovo.jpg'
            ],
            [
                'nombre' => 'Teclado Mecanico KIIBOOM MOONSHADOW V2',
                'marca' => 'KIIBOOM',
                'precio' => 450.00,
                'stock' => 15,
                'id_categoria' => 1, // Electrónica / Informática
                'foto' => 'KIIBOOM MOONSHADOW V2.jpg'
            ],
            [
                'nombre' => 'Hoodie Femboy',
                'marca' => 'FemboyLiving', // Tu marca aplicada
                'precio' => 89.90,
                'stock' => 30,
                'id_categoria' => 2, // Ropa y Accesorios
                'foto' => 'hoodie femboy.jpg'
            ],
            [
                'nombre' => 'Beanie Cat (Gorro de Lana)',
                'marca' => 'FemboyLiving', // Tu marca aplicada
                'precio' => 25.00,
                'stock' => 40,
                'id_categoria' => 2, // Ropa y Accesorios
                'foto' => 'beanie cat.jpg'
            ],
            [
                'nombre' => 'Cafe Altomayo Gourmet Doypack 150g',
                'marca' => 'Altomayo',
                'precio' => 19.50,
                'stock' => 100,
                'id_categoria' => 3, // Alimentos / Abarrotes
                'foto' => 'CAFE ALTOMAYO GOURMET DOY PACK X 150 G.jpg'
            ],
            [
                'nombre' => 'Avena Quaker',
                'marca' => 'Quaker',
                'precio' => 9.20,
                'stock' => 80,
                'id_categoria' => 3, // Alimentos / Abarrotes
                'foto' => 'avena quaker.jpg'
            ],
            [
                'nombre' => 'Tischlampe Paros von COREP Weiß (Lámpara de Mesa)',
                'marca' => 'COREP',
                'precio' => 120.00,
                'stock' => 20,
                'id_categoria' => 1, // Electrónica / Hogar
                'foto' => 'Tischlampe Paros von COREP Weiß.jpg'
            ],
            [
                'nombre' => 'Pelota de Voleibol Molten V5M4500',
                'marca' => 'Molten',
                'precio' => 135.00,
                'stock' => 15,
                'id_categoria' => 2, // Deportes / Accesorios
                'foto' => 'Molten V5M4500 wedstrijdvolleybal.jpg'
            ],
            [
                'nombre' => 'Femboy rico',
                'marca' => 'Femboyliving',
                'precio' => 999.99,
                'stock' => 1,
                'id_categoria' => 3, // Deportes / Accesorios
                'foto' => 'femboy.jpg'
            ],
        ];

        foreach ($productos as $prod) {
            Producto::create($prod);
        }

        $this->command->info('✔ Productos insertados: ' . count($productos));
    }
}

