<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
    public function crearProductos(){
        $producto = new Producto;
        $producto->nombre="Harina";
        $producto->descripcion="8 paquetes de 1Kg cada uno";
        $producto->stock=100;
        $producto->id_cat=1;
        $producto->save();
        $producto = new Producto;
        $producto->nombre="Azúcar";
        $producto->descripcion="20 paquetes de 1Kg cada uno";
        $producto->stock=30;
        $producto->id_cat=1;
        $producto->save();
        $producto = new Producto;
        $producto->nombre="Coca-Cola";
        $producto->descripcion="Blister de 6 botellas de 2L";
        $producto->stock=50;
        $producto->id_cat=2;
        $producto->save();
        $producto = new Producto;
        $producto->nombre="Clipper de Fresa";
        $producto->descripcion="Blister de 6 botellas de 1,5L";
        $producto->stock=60;
        $producto->id_cat=2;
        $producto->save();
        $producto = new Producto;
        $producto->nombre="Tropical";
        $producto->descripcion="Blister de 8 botellas de 1L";
        $producto->stock=150;
        $producto->id_cat=3;
        $producto->save();
        $producto = new Producto;
        $producto->nombre="Heineken";
        $producto->descripcion="Blister de 6 botellines de 500Cl";
        $producto->stock=80;
        $producto->id_cat=3;
        $producto->save();
    }
}
