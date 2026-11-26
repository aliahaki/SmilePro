<?php

namespace App\Http\Controllers;

use App\Services\HomePaginaService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class HomeController extends Controller
{
    public function __construct(
        private readonly HomePaginaService $homePaginaService
    ) {}

    // Toont de homepagina of een duidelijke foutmelding.
    public function index(): View|Response
    {
        try {
            $gegevens = $this->homePaginaService->getGegevens();

            return view('home.index', $gegevens);
        } catch (QueryException | RuntimeException $fout) {
            // De technische fout wordt alleen in Laravel gelogd.
            Log::error('SmilePro: homepagina kon niet laden.', [
                'fout' => $fout->getMessage(),
            ]);

            return response()->view('home.fout', [], 503);
        }
    }
}
