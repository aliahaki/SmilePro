<?php

namespace App\Http\Controllers;

use App\Providers\Patienten\Index;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function index(Index $index): View
    {
        return $index->index();
    }
}