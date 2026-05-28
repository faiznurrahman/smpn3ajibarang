<?php

namespace App\Filament\Resources\Members\Pages;

use App\Filament\Resources\Members\MemberResource;
use App\Imports\MembersImport;
use App\Imports\MembersUpdateKelasImport;
use App\Models\Member;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([

                // --- Import & Update ---
                Action::make('importAnggota')
                    ->label('Import Anggota Baru')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->modalHeading('Import Anggota Baru dari Excel')
                    ->modalDescription('Kolom wajib: nis, nama, kelas, angkatan. NIS yang sudah ada dilewati.')
                    ->modalSubmitActionLabel('Mulai Import')
                    ->form([
                        FileUpload::make('file')
                            ->label('File Excel (.xlsx)')
                            ->disk('local')
                            ->directory('tmp/member-imports')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        try {
                            $path   = Storage::disk('local')->path($data['file']);
                            $import = new MembersImport;
                            Excel::import($import, $path);
                            Storage::disk('local')->delete($data['file']);

                            Notification::make()
                                ->title('Import Selesai')
                                ->body("{$import->imported} anggota ditambahkan, {$import->skipped} dilewati.")
                                ->success()->send();
                        } catch (\Throwable $e) {
                            Notification::make()->title('Import Gagal')->body($e->getMessage())->danger()->send();
                        }
                    }),

                Action::make('updateKelas')
                    ->label('Update Kelas (Naik Kelas)')
                    ->icon('heroicon-o-academic-cap')
                    ->modalHeading('Update Kelas — Naik Kelas / Pindah Kelas')
                    ->modalDescription('Upload template update kelas yang sudah diisi kolom kelas_baru.')
                    ->modalSubmitActionLabel('Mulai Update')
                    ->form([
                        FileUpload::make('file')
                            ->label('File Excel (.xlsx)')
                            ->disk('local')
                            ->directory('tmp/member-imports')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'application/vnd.ms-excel',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        try {
                            $path   = Storage::disk('local')->path($data['file']);
                            $import = new MembersUpdateKelasImport;
                            Excel::import($import, $path);
                            Storage::disk('local')->delete($data['file']);

                            $msg = "{$import->updated} data kelas diupdate.";
                            if ($import->notFound > 0) {
                                $list = implode(', ', array_slice($import->notFoundList, 0, 10));
                                $more = count($import->notFoundList) > 10 ? ' +' . (count($import->notFoundList) - 10) . ' lainnya' : '';
                                $msg .= " NIS tidak ditemukan: {$list}{$more}.";
                            }

                            Notification::make()->title('Update Kelas Selesai')->body($msg)->success()->send();
                        } catch (\Throwable $e) {
                            Notification::make()->title('Update Gagal')->body($e->getMessage())->danger()->send();
                        }
                    }),

                Action::make('nonaktifAngkatan')
                    ->label('Nonaktifkan Angkatan Lulus')
                    ->icon('heroicon-o-user-minus')
                    ->color('danger')
                    ->modalHeading('Nonaktifkan Angkatan yang Lulus')
                    ->modalDescription('Status siswa akan diubah menjadi Lulus dan dinonaktifkan. Data dan riwayat peminjaman tetap tersimpan.')
                    ->modalSubmitActionLabel('Nonaktifkan')
                    ->form([
                        Select::make('angkatan')
                            ->label('Pilih Angkatan')
                            ->options(function () {
                                return Member::query()
                                    ->where('jenis', 'siswa')
                                    ->where('status', 'aktif')
                                    ->whereNotNull('tahun_masuk')
                                    ->select('tahun_masuk', DB::raw('count(*) as total'))
                                    ->groupBy('tahun_masuk')
                                    ->orderByDesc('tahun_masuk')
                                    ->get()
                                    ->mapWithKeys(fn ($r) => [
                                        $r->tahun_masuk => "Angkatan {$r->tahun_masuk} ({$r->total} siswa aktif)",
                                    ])
                                    ->toArray();
                            })
                            ->searchable()
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $count = Member::where('jenis', 'siswa')
                            ->where('tahun_masuk', $data['angkatan'])
                            ->where('status', 'aktif')
                            ->update(['status' => 'lulus', 'is_active' => false]);

                        Notification::make()
                            ->title('Angkatan Dinonaktifkan')
                            ->body("{$count} siswa angkatan {$data['angkatan']} diubah menjadi alumni.")
                            ->success()->send();
                    }),

                // --- Download template ---
                Action::make('downloadTemplateImport')
                    ->label('Unduh Template Import Anggota')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn () => route('members.template.import'))
                    ->openUrlInNewTab(),

                Action::make('downloadTemplateUpdateKelas')
                    ->label('Unduh Template Update Kelas')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn () => route('members.template.update-kelas'))
                    ->openUrlInNewTab(),

            ])
            ->label('Kelola Massal')
            ->icon('heroicon-o-cog-6-tooth')
            ->color('gray')
            ->button(),

            CreateAction::make()->label('Tambah Anggota'),
        ];
    }
}
