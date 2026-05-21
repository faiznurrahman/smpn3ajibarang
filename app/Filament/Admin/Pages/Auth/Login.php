<?php

namespace App\Filament\Admin\Pages\Auth;

use App\Models\Setting;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Component;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    protected static string $layout = 'filament.admin.auth.login-layout';

    public ?Setting $schoolSettings = null;

    public function mount(): void
    {
        parent::mount();
        $this->schoolSettings = Setting::first();
    }

    /**
     * Mengembalikan null agar fi-simple-header tidak dirender —
     * mencegah duplikasi judul & nama sekolah di dalam card.
     */
    public function getHeading(): string | Htmlable | null
    {
        return null;
    }

    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()->label('Alamat Email');
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()->label('Kata Sandi');
    }

    protected function getRememberFormComponent(): Component
    {
        return parent::getRememberFormComponent()->label('Ingat Saya');
    }

    protected function getAuthenticateFormAction(): Action
    {
        return parent::getAuthenticateFormAction()->label('Masuk');
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $user = User::where('email', $data['email'])->first();

        if ($user && ! $user->is_active) {
            throw ValidationException::withMessages([
                'data.email' => __('Akun Anda telah dinonaktifkan. Hubungi Administrator.'),
            ]);
        }

        return parent::authenticate();
    }
}
