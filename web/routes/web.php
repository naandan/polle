<?php

use App\Livewire\Client;
use App\Livewire\Login;
use App\Livewire\Vote;
use Illuminate\Support\Facades\Route;

Route::get('/', Client::class)->name('voter.index');
Route::get('/vote', Login::class)->name('voter.login');
Route::get('/vote/{token}', Vote::class)->name('voter.poll');
