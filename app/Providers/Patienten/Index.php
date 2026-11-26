<?php

namespace App\Providers\Patienten;

use App\Models\Patient;
use Illuminate\View\View;

class Index
{
    public function index(): View
    {
        $patienten = Patient::query()
            ->orderBy('Achternaam')
            ->orderBy('Voornaam')
            ->get(['Voornaam', 'Achternaam', 'Geboortedatum']);

        return view('patienten.index', compact('patienten'));
    }
}