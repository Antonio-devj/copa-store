<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['country_id', 'name', 'description', 'price', 'stock', 'image'];

    // Relacionamento: O produto pertence a um país
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}