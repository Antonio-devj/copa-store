<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $fillable = ['name', 'history', 'journey', 'titles_count', 'flag_image'];

    // Relacionamento: Um país tem muitos produtos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}