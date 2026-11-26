<?php

namespace App\Http\Controllers;

use App\Providers\Agenda\Index;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(Request $request, Index $index): View
    {
        return $index->index($request);
    }
}