<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MedewerkerModel extends Model
{
    protected $table = 'Medewerker';

    public $timestamps = false;

    public static function medewerkerOverzicht()
    {
        return collect(DB::select('CALL sp_MedewerkerOverzicht()'));
    }
}