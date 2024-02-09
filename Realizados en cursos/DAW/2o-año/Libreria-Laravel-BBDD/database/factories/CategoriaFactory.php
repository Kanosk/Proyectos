<?php

namespace Database\Factories;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
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
    public function crearCategoria(){
        $categoria = new Categoria;
        $categoria->nombre="Comida";
        $categoria->descripcion="Platos e ingredientes";
        $categoria->save();
        $categoria = new Categoria;
        $categoria->nombre="Bebida sin";
        $categoria->descripcion="Bebidas sin alcohol";
        $categoria->save();
        $categoria = new Categoria;
        $categoria->nombre="Bebida con";
        $categoria->descripcion="Bebidas con alcohol";
        $categoria->save();
    }
}
