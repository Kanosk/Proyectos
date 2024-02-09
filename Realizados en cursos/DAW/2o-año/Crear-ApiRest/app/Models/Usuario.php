<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;
    protected $table = "usuarios";

    protected $fillable=[
        'nombre',
        'apellidos',
        'email'
    ];
    public function posts():HasMany{
        return $this->hasMany(Post::class);
    }
}
