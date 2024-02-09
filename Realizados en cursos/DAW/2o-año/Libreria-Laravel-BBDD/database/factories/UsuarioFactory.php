<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Usuario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UsuarioFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => static::$password ??= Hash::make('password'),
        //     'remember_token' => Str::random(10),
        // ];
        // return [
        //     'user' => "root@mail.com",
        //     'password' => "1234",

        // ];
        return [
            ];
    }
    public function crearUser(){
        $usuario = new Usuario();
        $usuario->user="Admin@empresa.com";
        $usuario->password = "1234";
        $usuario->save();
        $usuario = new Usuario();
        $usuario->user="Cano@empresa.com";
        $usuario->password = "1234";
        $usuario->save();
        $usuario = new Usuario();
        $usuario->user="Yeray@empresa.com";
        $usuario->password = "1234";
        $usuario->save();
    }

    /**
     * Indicate that the model's email address should be unverified.
     */

}
