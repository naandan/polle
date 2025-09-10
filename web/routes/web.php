<?php

use Carbon\Carbon;
use App\Models\Token;
use App\Livewire\Vote;
use App\Livewire\Login;
use App\Livewire\Client;
use Illuminate\Support\Facades\Route;

Route::get('/vote/success/{token}', function ($token) {
    $voteToken = Token::with('poll')->where('token', $token)->first();
    $poll      = $voteToken?->poll;
    $now       = Carbon::now();

    if (
        ! $voteToken ||
        is_null($voteToken->used_at) ||
        ! $poll ||
        ($poll->end_at && $now->gt($poll->end_at))
    ) {
        abort(404, 'Not Found');
    }

    return view('livewire.result', [
        'voteToken' => $voteToken,
    ]);
})->name('voter.success');

Route::get('/privacy', function () {
    return view('client.privacy',);
})->name('privacy');

Route::get('/terms', function () {
    return view('client.terms',);
})->name('terms');

Route::get('/', Client::class)->name('voter.index');
Route::get('/vote', Login::class)->name('voter.login');
Route::get('/vote/{token}', Vote::class)->name('voter.poll');
