<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::view('/', 'welcome')->name('home');

Route::get('/online-registration', [RegistrationController::class, 'index'])->name('online-registration');
Route::get('/registration/residential', [RegistrationController::class, 'residential'])->name('registration.residential');
Route::get('/registration/public', [RegistrationController::class, 'public'])->name('registration.public');
Route::post('/registration/residential/search', [RegistrationController::class, 'residentialSearch'])->name('residential.search');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/members', 'members.index')->name('members.index');
    Route::livewire('/members/{xR?}/{membershipNo?}', 'members.view')->name('members.view');

    Route::livewire('/Attendees', 'attendees.index')->name('attendees.index');

});

require __DIR__.'/settings.php';
