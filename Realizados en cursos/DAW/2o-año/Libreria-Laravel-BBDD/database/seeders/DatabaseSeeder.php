<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(usuariosSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);

        // \App\Models\User::factory(10)->create();

    //     \App\Models\Usuario::factory()->create([
    //         'user' => 'root@mail.com',
    //         'password' => '1234',
    //     ]);
    //
    }
}
