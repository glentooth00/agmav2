<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('/members', 'members.index')->name('members.index');
    Route::livewire('/members/{membershipId}/{membershipNo}','members.view')->name('members.view');
});

require __DIR__.'/settings.php';
