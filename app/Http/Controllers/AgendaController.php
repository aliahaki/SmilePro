<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $gegevens = $request->validate([
            'datum' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $datum = $gegevens['datum'] ?? now('Europe/Amsterdam')->toDateString();

        $afspraken = DB::table('Afspraak as afspraak')
            ->join('Patient as patient', 'patient.Id', '=', 'afspraak.PatientId')
            ->join('behandeling as behandeling', 'behandeling.Id', '=', 'afspraak.BehandelingId')
            ->whereDate('afspraak.StartDatumTijd', $datum)
            ->orderBy('afspraak.StartDatumTijd')
            ->get([
                'afspraak.StartDatumTijd',
                'patient.Voornaam',
                'patient.Achternaam',
                'behandeling.Naam as Behandeling',
            ]);

        return view('agenda.index', compact('datum', 'afspraken'));
    }
}