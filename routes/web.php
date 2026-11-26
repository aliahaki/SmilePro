<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedewerkerController;


Route::get('/', function () {
    return view('welcome');
});

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/patienten', [PatientController::class, 'index'])
    ->name('patienten.index');

Route::get('/medewerkers', [MedewerkerController::class, 'index'])
    ->name('Medewerker.index');