<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'Patient';
    protected $primaryKey = 'Id';

    public const CREATED_AT = 'Datumaangemaakt';
    public const UPDATED_AT = 'Datumgewijzigd';

    protected $hidden = ['Wachtwoord'];
}
