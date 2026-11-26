<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'Agenda';
    protected $primaryKey = 'Id';

    public const CREATED_AT = 'Datumaangemaakt';
    public const UPDATED_AT = 'Datumgewijzigd';
}
