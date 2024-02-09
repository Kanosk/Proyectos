<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'cuerpo' => $this->cuerpo,
            'imagen' => $this->imagen,
            'usuario_id' => $this->usuario_id,
            'categoria_id' => $this->categoria_id
        ];
    }
}
