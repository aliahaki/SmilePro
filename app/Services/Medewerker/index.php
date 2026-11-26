<?php

namespace App\Services\Medewerker;

use App\Models\MedewerkerModel;

class Index
{
    private MedewerkerModel $medewerkerModel;

    public function __construct()
    {
        $this->medewerkerModel = new MedewerkerModel();
    }

    public function index()
    {
        $medewerkers = MedewerkerModel::medewerkerOverzicht();

        return view('Medewerker.index', [
            'title' => 'Medewerker overzicht',
            'medewerkers' => $medewerkers,
        ]);
    }
}