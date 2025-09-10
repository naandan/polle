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

Route::get('/', function () {
    return view('client.client', [
        'seo' => [
            'title' => 'Beranda - Polle',
            'description' => 'Selamat datang di Polle, platform polling online cepat dan mudah. Buat dan ikuti vote dengan mudah tanpa harus daftar.',
            'keywords' => 'polling online, voting cepat, buat vote, ikuti vote',
            'image' => asset('og-image.png')
        ]
    ]);
})->name('index');

Route::get('/privacy', function () {
    return view('client.privacy', [
        'seo' => [
            'title' => 'Kebijakan Privasi - Polle',
            'description' => 'Pelajari bagaimana Polle menjaga data dan privasi pengguna dengan aman sesuai standar keamanan.',
            'keywords' => 'kebijakan privasi, data pengguna, keamanan data',
            'image' => asset('og-image.png')
        ]
    ]);
})->name('privacy');

Route::get('/terms', function () {
    return view('client.terms', [
        'seo' => [
            'title' => 'Syarat & Ketentuan - Polle',
            'description' => 'Baca syarat dan ketentuan penggunaan Polle untuk memahami hak dan kewajiban pengguna saat menggunakan platform.',
            'keywords' => 'syarat penggunaan, ketentuan, hak pengguna, kewajiban pengguna',
            'image' => asset('og-image.png')
        ]
    ]);
})->name('terms');


Route::get('/vote', Login::class)->name('voter.login');
Route::get('/vote/{token}', Vote::class)->name('voter.poll');
