<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\Schema; // Añadimos esto para controlar las llaves foráneas

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Desactivamos la revisión de llaves foráneas para que te deje usar el truncate del profe
        Schema::disableForeignKeyConstraints();

        // Limpia la tabla antes de insertar (evita duplicados)
        Categoria::truncate();

        // 2. Volvemos a activar la revisión inmediatamente después de limpiar
        Schema::enableForeignKeyConstraints();

        $categorias = [
            ['descripcion' => 'Electrónica'],
            ['descripcion' => 'Ropa y Accesorios'],
            ['descripcion' => 'Alimentos y Bebidas'],
            ['descripcion' => 'Hogar y Jardín'],
            ['descripcion' => 'Deportes'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }

        $this->command->info('✔ Categorías insertadas: ' . count($categorias));
    }
}