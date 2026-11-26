<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomePaginaOnderdeel extends Model
{
    protected $table = 'homepagina_onderdelen';

    public function homepagina(): BelongsTo
    {
        return $this->belongsTo(
            HomePaginaGegeven::class,
            'homepagina_id'
        );
    }
}
