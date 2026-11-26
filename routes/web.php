
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Homepagina van SmilePro
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard van het team
Route::view('/dashboard', 'dashboard')->name('dashboard');
