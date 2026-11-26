<?php

namespace App\Services;

use App\Models\HomePaginaGegeven;
use App\Models\HomePaginaOnderdeel;
use RuntimeException;

class HomePaginaService
{
    // Haalt gegevens voor de openbare homepagina op.
    public function getGegevens(): array
    {
        $pagina = HomePaginaGegeven::query()->find(1);

        if ($pagina === null) {
            throw new RuntimeException(
                'De homepagina-informatie ontbreekt.'
            );
        }

        // SQL JOIN tussen homepagina_onderdelen
        // en homepagina_gegevens.
        $onderdelen = HomePaginaOnderdeel::query()
            ->join(
                'homepagina_gegevens as pagina',
                'pagina.id',
                '=',
                'homepagina_onderdelen.homepagina_id'
            )
            ->where('pagina.id', $pagina->id)
            ->select('homepagina_onderdelen.*')
            ->orderBy('homepagina_onderdelen.volgorde')
            ->get();

        $behandelingen = [];
        $teamleden = [];

        foreach ($onderdelen as $onderdeel) {
            if ($onderdeel->soort === 'behandeling') {
                $behandelingen[] = [
                    'naam' => $onderdeel->naam,
                    'beschrijving' => $onderdeel->beschrijving,
                    'icoon' => $onderdeel->icoon,
                ];
            }

            if ($onderdeel->soort === 'team') {
                $teamleden[] = [
                    'naam' => $onderdeel->naam,
                    'functie' => $onderdeel->functie,
                    'foto' => $onderdeel->afbeelding_url,
                ];
            }
        }

        return [
            'pagina' => $pagina,

            // Afbeeldingen via URL, geen afbeeldingenmap.
            'afbeeldingen' => [
                'hero' => 'https://images.unsplash.com/photo-1777331903190-341a3dd0441b?auto=format&fit=crop&w=1600&q=85',
                'praktijk' => 'https://images.unsplash.com/photo-1643660527098-559f89e45a92?auto=format&fit=crop&w=1100&q=85',
            ],

            'statistieken' => [
                ['waarde' => '15+', 'tekst' => 'jaar ervaring'],
                ['waarde' => '4.800', 'tekst' => 'tevreden patiënten'],
                ['waarde' => '12', 'tekst' => 'zorgprofessionals'],
                ['waarde' => '5 dagen', 'tekst' => 'per week geopend'],
            ],

            'behandelingen' => $behandelingen,
            'teamleden' => $teamleden,

            'openingstijden' => [
                ['dag' => 'Maandag', 'tijd' => '08:00 – 17:00'],
                ['dag' => 'Dinsdag', 'tijd' => '08:00 – 20:00'],
                ['dag' => 'Woensdag', 'tijd' => '08:00 – 17:00'],
                ['dag' => 'Donderdag', 'tijd' => '08:00 – 20:00'],
                ['dag' => 'Vrijdag', 'tijd' => '08:00 – 16:00'],
            ],
        ];
    }
}
