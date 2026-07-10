<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Models\Member;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListMembers extends Page
{
    protected static string $resource = MemberResource::class;

    protected string $view = 'filament.admin.resources.members.pages.list-members';

    public function getTitle(): string
    {
        return 'Data anggota';
    }

    // ── State ──────────────────────────────────────────────────────
    public string $activeTab    = 'aktif';
    public string $search       = '';
    public string $filterJenis  = '';
    public string $filterStatus = '';
    public int    $page         = 1;
    public int    $perPage      = 15;

    // ── Data ───────────────────────────────────────────────────────

    public function getData(): LengthAwarePaginator
    {
        $q = Member::query();

        match ($this->activeTab) {
            'aktif'    => $q->where('is_active', true),
            'nonaktif' => $q->where('is_active', false),
            default    => null,
        };

        if ($this->filterJenis !== '') {
            $q->where('jenis', $this->filterJenis);
        }

        if ($this->filterStatus !== '') {
            $q->where('status', $this->filterStatus);
        }

        if (trim($this->search) !== '') {
            $s = $this->search;
            $q->where(function ($q2) use ($s) {
                $q2->where('nama', 'like', "%{$s}%")
                    ->orWhere('kode_anggota', 'like', "%{$s}%");
            });
        }

        return $q->orderBy('nama')
            ->paginate($this->perPage, ['*'], 'mbr_page', $this->page);
    }

    public function getCreateUrl(): string
    {
        return MemberResource::getUrl('create');
    }

    public function getEditUrl(Member $member): string
    {
        return MemberResource::getUrl('edit', ['record' => $member]);
    }

    // ── Lifecycle ──────────────────────────────────────────────────

    public function updatedSearch(): void
    {
        $this->page = 1;
    }

    public function updatedActiveTab(): void
    {
        $this->page = 1;
    }

    public function updatedFilterJenis(): void
    {
        $this->page = 1;
    }

    public function updatedFilterStatus(): void
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
}
