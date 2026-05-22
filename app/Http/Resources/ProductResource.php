<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'descricao' => $this->description,
            'preco' => $this->price,
            'estoque' => $this->stock,
            'pais' => $this->country->name, // Puxa o nome do país através do relacionamento
            'imagem_url' => $this->image ? asset('storage/' . $this->image) : null,
        ];
    }
}