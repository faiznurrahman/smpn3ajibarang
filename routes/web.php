<?php

use App\Enums\UserRole;
use App\Exports\BooksTemplateExport;
use App\Exports\MembersTemplateExport;
use App\Exports\MembersUpdateKelasTemplateExport;
use App\Http\Controllers\LibraryExcelController;
use App\Http\Controllers\LibraryKioskController;
use App\Http\Controllers\LibraryPdfController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\TrackWebsiteVisit;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

// Public website pages — tracked for visitor statistics
Route::middleware([TrackWebsiteVisit::class])->group(function () {
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
    Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
});
Route::post('/kontak', [PageController::class, 'sendMessage'])->name('contact.send');

// Laporan PDF Perpustakaan (Petugas + Kepala)
Route::get('/admin/laporan-perpustakaan/pdf', [LibraryPdfController::class, 'download'])
    ->middleware(['auth'])
    ->name('laporan.perpustakaan.pdf');

// Laporan Excel Perpustakaan (Petugas + Kepala)
Route::get('/admin/laporan-perpustakaan/excel', [LibraryExcelController::class, 'download'])
    ->middleware(['auth'])
    ->name('laporan.perpustakaan.excel');

// Template import buku (Petugas saja)
Route::get('/admin/books/template', function () {
    abort_unless(auth()->user()?->role === UserRole::PetugasPerpustakaan, 403);
    return Excel::download(new BooksTemplateExport, 'template-import-buku.xlsx');
})->middleware(['auth'])->name('books.template');

// Template anggota (Petugas saja)
Route::middleware(['auth'])->prefix('/admin/members/template')->name('members.template.')->group(function () {
    Route::get('/import', function () {
        abort_unless(auth()->user()?->role === UserRole::PetugasPerpustakaan, 403);
        return Excel::download(new MembersTemplateExport, 'template-import-anggota.xlsx');
    })->name('import');

    Route::get('/update-kelas', function () {
        abort_unless(auth()->user()?->role === UserRole::PetugasPerpustakaan, 403);
        return Excel::download(new MembersUpdateKelasTemplateExport, 'template-update-kelas.xlsx');
    })->name('update-kelas');
});

// Kiosk Perpustakaan
Route::prefix('perpustakaan')->name('perpustakaan.')->group(function () {
    Route::get('/',             [LibraryKioskController::class, 'index'])->name('index');
    Route::get('/hadir',           [LibraryKioskController::class, 'hadir'])->name('hadir');
    Route::post('/hadir',          [LibraryKioskController::class, 'simpanHadir'])->name('hadir.simpan');
    Route::get('/hadir/sukses',    [LibraryKioskController::class, 'hadirSukses'])->name('hadir.sukses');
    Route::get('/anggota/cari',    [LibraryKioskController::class, 'cariAnggota'])->name('anggota.cari');
    Route::get('/katalog',      [LibraryKioskController::class, 'katalog'])->name('katalog');
});
