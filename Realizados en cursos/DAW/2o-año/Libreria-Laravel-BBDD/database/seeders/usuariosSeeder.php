<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Usuario;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $usuario = new Usuario();
        // $usuario->user="root@mail.com";
        // $usuario->password = "1234";
        // $usuario->save();
        // $usuario = new Usuario();
        // $usuario->user="otro@mail.com";
        // $usuario->password = "1234";
        // $usuario->save();

        Usuario::factory()->crearUser();

    }
}
