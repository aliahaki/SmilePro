
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedewerkerController;


// Homepagina van SmilePro
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/patienten', [PatientController::class, 'index'])
    ->name('patienten.index');

Route::get('/medewerkers', [MedewerkerController::class, 'index'])
    ->name('Medewerker.index');
// Dashboard van het team
Route::view('/dashboard', 'dashboard')->name('dashboard');
