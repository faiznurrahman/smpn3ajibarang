<?php

namespace App\Filament\Resources\Visits\Pages;

use App\Filament\Resources\Visits\VisitResource;
use App\Models\Visit;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListVisits extends Page
{
    protected static string $resource = VisitResource::class;

    protected string $view = 'filament.admin.resources.visits.pages.list-visits';

    public function getTitle(): string
    {
        return 'Data kunjungan';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab       = 'hari_ini';
    public string $search          = '';
    public string $filterJenis     = '';
    public string $filterKeperluan = '';
    public string $filterDari      = '';
    public string $filterSampai    = '';
    public int    $page            = 1;
    public int    $perPage         = 15;

    // ── Bulk select ────────────────────────────────────────────────
    public array $selected = [];

    // ── Modal hapus ────────────────────────────────────────────────
    public bool  $showDeleteModal = false;
    public array $deleteTargetIds = [];

    // ── Data ───────────────────────────────────────────────────────

    public function getTabCounts(): array
    {
        return [
            'hari_ini'   => Visit::whereDate('tgl_kunjungan', today())->count(),
            'minggu_ini' => Visit::whereBetween('tgl_kunjungan', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString(),
            ])->count(),
            'bulan_ini' => Visit::whereMonth('tgl_kunjungan', now()->month)
                ->whereYear('tgl_kunjungan', now()->year)
                ->count(),
            'semua' => Visit::count(),
        ];
    }

    public function getData(): LengthAwarePaginator
    {
        $q = Visit::query();

        match ($this->activeTab) {
            'hari_ini'   => $q->whereDate('tgl_kunjungan', today()),
            'minggu_ini' => $q->whereBetween('tgl_kunjungan', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString(),
            ]),
            'bulan_ini' => $q->whereMonth('tgl_kunjungan', now()->month)
                ->whereYear('tgl_kunjungan', now()->year),
            default => null,
        };

        if ($this->filterJenis !== '') {
            $q->where('jenis_pengunjung', $this->filterJenis);
        }

        if ($this->filterKeperluan !== '') {
            $q->where('keperluan', $this->filterKeperluan);
        }

        if ($this->filterDari !== '') {
            $q->whereDate('tgl_kunjungan', '>=', $this->filterDari);
        }

        if ($this->filterSampai !== '') {
            $q->whereDate('tgl_kunjungan', '<=', $this->filterSampai);
        }

        if (trim($this->search) !== '') {
            $q->where('nama', 'like', '%' . $this->search . '%');
        }

        return $q->orderByDesc('tgl_kunjungan')
            ->orderByDesc('jam_kunjungan')
            ->paginate($this->perPage, ['*'], 'kjn_page', $this->page);
    }

    // ── Lifecycle ──────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedActiveTab(): void
    {
        $this->page = 1;
        $this->selected = [];
    }

    public function updatedFilterJenis(): void
    {
        $this->page = 1;
    }

    public function updatedFilterKeperluan(): void
    {
        $this->page = 1;
    }

    public function updatedFilterDari(): void
    {
        $this->page = 1;
    }

    public function updatedFilterSampai(): void
    {
        $this->page = 1;
    }

    // ── Pagination ─────────────────────────────────────────────────

    public function nextPage(): void
    {
        $this->page++;
    }

    public function prevPage(): void
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    // ── Bulk select ────────────────────────────────────────────────

    public function toggleSelectAllPage(): void
    {
        $idsOnPage = $this->getData()->pluck('id')->map(fn ($id) => (string) $id)->toArray();
        $allSelected = empty(array_diff($idsOnPage, $this->selected));

        if ($allSelected) {
            $this->selected = array_values(array_diff($this->selected, $idsOnPage));
        } else {
            $this->selected = array_values(array_unique(array_merge($this->selected, $idsOnPage)));
        }
    }

    public function clearSelection(): void
    {
        $this->selected = [];
    }

    // ── Hapus ──────────────────────────────────────────────────────

    public function bukaHapus(int $id): void
    {
        $this->deleteTargetIds = [$id];
        $this->showDeleteModal = true;
    }

    public function bukaHapusTerpilih(): void
    {
        if (empty($this->selected)) {
            return;
        }

        $this->deleteTargetIds = $this->selected;
        $this->showDeleteModal = true;
    }

    public function batalHapus(): void
    {
        $this->showDeleteModal = false;
        $this->deleteTargetIds = [];
    }

    public function konfirmasiHapus(): void
    {
        $count = Visit::whereIn('id', $this->deleteTargetIds)->count();
        Visit::whereIn('id', $this->deleteTargetIds)->delete();

        $this->selected = array_values(array_diff($this->selected, $this->deleteTargetIds));
        $this->deleteTargetIds = [];
        $this->showDeleteModal = false;

        Notification::make()->title("{$count} data kunjungan berhasil dihapus")->success()->send();
    }
}
