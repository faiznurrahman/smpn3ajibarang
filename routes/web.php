<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

// Tentang Kami
Route::prefix('tentang')->name('about.')->group(function () {
    Route::get('/sejarah',             [PageController::class, 'sejarah'])->name('sejarah');
    Route::get('/visi-misi',           [PageController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/struktur-organisasi', [PageController::class, 'strukturOrganisasi'])->name('struktur-organisasi');
    Route::get('/pengajar',            [PageController::class, 'pengajar'])->name('pengajar');
    Route::get('/ekstrakurikuler',     [PageController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
});

// Informasi
Route::get('/informasi',        [PageController::class, 'information'])->name('information');
Route::get('/informasi/{slug}', [PageController::class, 'informationDetail'])->name('information.detail');

// Galeri
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');

// Kontak
Route::get('/kontak',  [PageController::class, 'contact'])->name('contact');
Route::post('/kontak', [PageController::class, 'sendMessage'])->name('contact.send');