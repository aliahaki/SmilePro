<?php

namespace App\Http\Controllers;

use App\Services\Medewerker\Index;

use Illuminate\Http\Request;

class MedewerkerController extends Controller
{
    //index 

    public function index()
    {
        $index = new Index;

        return $index->Index();
    }

    
}
