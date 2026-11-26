<?php

namespace App\Providers\Agenda;

use App\Models\Agenda;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Index
{
    public function index(Request $request): View
    {
        $gegevens = $request->validate([
            'datum' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $datum = $gegevens['datum'] ?? now('Europe/Amsterdam')->toDateString();

        $gekozenDag = CarbonImmutable::parse($datum)->locale('nl');
        $maandStart = $gekozenDag->startOfMonth();
        $volgendeMaand = $maandStart->addMonth();

        $afsprakenPerDag = Agenda::query()
            ->from('Afspraak as afspraak')
            ->join('Patient as patient', 'patient.Id', '=', 'afspraak.PatientId')
            ->join('behandeling', 'behandeling.Id', '=', 'afspraak.BehandelingId')
            ->where('afspraak.StartDatumTijd', '>=', $maandStart->toDateTimeString())
            ->where('afspraak.StartDatumTijd', '<', $volgendeMaand->toDateTimeString())
            ->orderBy('afspraak.StartDatumTijd')
            ->select([
                'afspraak.StartDatumTijd',
                'patient.Voornaam',
                'patient.Achternaam',
                'behandeling.Naam as Behandeling',
            ])
            ->selectRaw('DATE(afspraak.StartDatumTijd) as Datum')
            ->get()
            ->groupBy('Datum');

        $afspraken = $afsprakenPerDag->get($datum, collect());
        $toonLegeDagPopup = $request->boolean('dag') && $afspraken->isEmpty();

        return view('agenda.index', compact(
            'datum',
            'gekozenDag',
            'maandStart',
            'afsprakenPerDag',
            'afspraken',
            'toonLegeDagPopup',
        ));
    }
}