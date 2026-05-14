<?php

namespace App\Filament\Admin\Pages\Auth;

use App\Models\Setting;
use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    protected static string $layout = 'filament.admin.auth.login-layout';

    public ?Setting $schoolSettings = null;

    public function mount(): void
    {
        parent::mount();
        $this->schoolSettings = Setting::first();
    }
}
