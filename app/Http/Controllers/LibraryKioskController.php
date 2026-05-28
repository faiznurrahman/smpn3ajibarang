<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Visit;
use Illuminate\Http\Request;

class LibraryKioskController extends Controller
{
    public function index()
    {
        return view('perpustakaan.index');
    }

    public function hadir()
    {
        return view('perpustakaan.hadir');
    }

    public function simpanHadir(Request $request)
    {
        $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'kelas'     => ['nullable', 'string', 'max:20'],
            'keperluan' => ['required', 'string', 'max:100'],
        ]);

        Visit::create([
            'nama'              => $request->nama,
            'jenis_pengunjung'  => $request->jenis_pengunjung ?: 'umum',
            'kelas'             => $request->kelas ?: null,
            'keperluan'         => $request->keperluan,
            'tgl_kunjungan'     => now()->toDateString(),
            'jam_kunjungan'     => now()->format('H:i:s'),
        ]);

        return redirect()->route('perpustakaan.hadir.sukses', [
            'nama' => $request->nama,
        ]);
    }

    public function hadirSukses(Request $request)
    {
        $nama = $request->query('nama', 'Pengunjung');
        return view('perpustakaan.hadir-sukses', compact('nama'));
    }

    public function cariAnggota(Request $request)
    {
        $q     = trim($request->query('q', ''));
        $jenis = $request->query('jenis', 'siswa'); // siswa | guru

        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = Member::where('is_active', true)
            ->where('jenis', $jenis === 'guru' ? 'guru' : 'siswa')
            ->where('nama', 'like', "%{$q}%")
            ->orderBy('nama')
            ->limit(8)
            ->get(['id', 'kode_anggota', 'nama', 'kelas', 'jenis']);

        return response()->json($results);
    }

    public function katalog(Request $request)
    {
        $query = Book::where('is_active', true);

        if ($request->filled('cari')) {
            $cari = $request->input('cari');
            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                  ->orWhere('penulis', 'like', "%{$cari}%")
                  ->orWhere('penerbit', 'like', "%{$cari}%")
                  ->orWhere('kode_buku', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        $books      = $query->orderBy('judul')->paginate(12)->withQueryString();
        $categories = Book::where('is_active', true)
                          ->distinct()
                          ->orderBy('kategori')
                          ->pluck('kategori')
                          ->filter()
                          ->values();

        return view('perpustakaan.katalog', compact('books', 'categories'));
    }
}
