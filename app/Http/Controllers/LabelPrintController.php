<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Book;
use App\Models\BookItem;
use App\Models\Textbook;
use App\Models\TextbookItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LabelPrintController extends Controller
{
    public function cetakSemua()
    {
        $this->authorizePetugas();

        $items = BookItem::with('book')
            ->orderBy('book_id')
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Belum ada eksemplar buku.');

        return $this->cetak($items, 'Label-Eksemplar-Semua-Buku');
    }

    public function cetakPerBuku(Request $request)
    {
        $this->authorizePetugas();

        $bookIds = array_filter(explode(',', (string) $request->query('book_ids')));

        abort_if(empty($bookIds), 404, 'Tidak ada buku yang dipilih.');

        $items = BookItem::with('book')
            ->whereIn('book_id', $bookIds)
            ->orderBy('book_id')
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Buku yang dipilih belum memiliki eksemplar.');

        $judulFile = $items->count() === 1 || Book::whereIn('id', $bookIds)->count() === 1
            ? Str::slug($items->first()->book?->kode_buku ?? 'buku')
            : 'Beberapa-Buku';

        return $this->cetak($items, 'Label-Eksemplar-' . $judulFile);
    }

    public function cetakTerpilih(Request $request)
    {
        $this->authorizePetugas();

        $ids = array_filter(explode(',', (string) $request->query('ids')));

        $items = BookItem::with('book')
            ->whereIn('id', $ids)
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Tidak ada eksemplar yang dipilih.');

        return $this->cetak($items, 'Label-Eksemplar-Terpilih');
    }

    public function cetakSemuaPaket()
    {
        $this->authorizePetugas();

        $items = TextbookItem::with('textbook')
            ->orderBy('textbook_id')
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Belum ada eksemplar buku paket.');

        return $this->cetakPaket($items, 'Label-Eksemplar-Semua-Buku-Paket');
    }

    public function cetakPerBukuPaket(Request $request)
    {
        $this->authorizePetugas();

        $textbookIds = array_filter(explode(',', (string) $request->query('textbook_ids')));

        abort_if(empty($textbookIds), 404, 'Tidak ada buku paket yang dipilih.');

        $items = TextbookItem::with('textbook')
            ->whereIn('textbook_id', $textbookIds)
            ->orderBy('textbook_id')
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Buku paket yang dipilih belum memiliki eksemplar.');

        $judulFile = $items->count() === 1 || Textbook::whereIn('id', $textbookIds)->count() === 1
            ? Str::slug($items->first()->textbook?->judul ?? 'buku-paket')
            : 'Beberapa-Buku-Paket';

        return $this->cetakPaket($items, 'Label-Eksemplar-' . $judulFile);
    }

    public function cetakTerpilihPaket(Request $request)
    {
        $this->authorizePetugas();

        $ids = array_filter(explode(',', (string) $request->query('ids')));

        $items = TextbookItem::with('textbook')
            ->whereIn('id', $ids)
            ->orderBy('kode_item')
            ->get();

        abort_if($items->isEmpty(), 404, 'Tidak ada eksemplar yang dipilih.');

        return $this->cetakPaket($items, 'Label-Eksemplar-Paket-Terpilih');
    }

    private function authorizePetugas(): void
    {
        abort_unless(auth()->user()?->role === UserRole::PetugasPerpustakaan, 403);
    }

    private function cetak($items, string $filename)
    {
        $labels = $items->map(fn (BookItem $item) => [
            'kode_item' => $item->kode_item,
            'judul'     => Str::limit($item->book?->judul ?? '-', 40),
            'qr'        => base64_encode(
                QrCode::format('svg')->size(150)->margin(1)->generate($item->kode_item)
            ),
        ]);

        return $this->render($labels, $filename);
    }

    private function cetakPaket($items, string $filename)
    {
        $labels = $items->map(fn (TextbookItem $item) => [
            'kode_item' => $item->kode_item,
            'judul'     => Str::limit($item->textbook?->judul ?? '-', 40),
            'qr'        => base64_encode(
                QrCode::format('svg')->size(150)->margin(1)->generate($item->kode_item)
            ),
        ]);

        return $this->render($labels, $filename);
    }

    private function render($labels, string $filename)
    {
        $pdf = Pdf::loadView('pdf.label-eksemplar', ['labels' => $labels])
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
                'defaultFont'          => 'DejaVu Sans',
            ]);

        return $pdf->download($filename . '.pdf');
    }
}
