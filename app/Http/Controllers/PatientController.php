<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patienten = DB::table('Patient')
            ->select('Voornaam', 'Achternaam', 'Geboortedatum')
            ->orderBy('Achternaam')
            ->orderBy('Voornaam')
            ->get();

        return view('patienten.index', compact('patienten'));
    }
}