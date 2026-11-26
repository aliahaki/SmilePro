<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomePaginaGegeven extends Model
{
    protected $table = 'homepagina_gegevens';

    public function onderdelen(): HasMany
    {
        return $this->hasMany(
            HomePaginaOnderdeel::class,
            'homepagina_id'
        );
    }
}
