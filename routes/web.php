
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;


// Homepagina van SmilePro
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/dashboard', 'dashboard')->name('dashboard');

Route::get('/patienten', [PatientController::class, 'index'])
    ->name('patienten.index');
