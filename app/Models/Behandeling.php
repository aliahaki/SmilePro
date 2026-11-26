<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Behandeling extends Model
{
    protected $table = 'behandeling';
    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'Datumgewijzigd';
}
