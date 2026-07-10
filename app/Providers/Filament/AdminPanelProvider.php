<?php

namespace App\Providers\Filament;


use App\Filament\Admin\Pages\Auth\Login;
use App\Filament\Admin\Pages\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->brandName('SMPN 3 Ajibarang')
            ->favicon(function () {
                $logo = \App\Models\Setting::first()?->logo;
                return $logo ? \Illuminate\Support\Facades\Storage::url($logo) : null;
            })
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->darkMode(false)
            ->globalSearch(false)
            ->renderHook(
                PanelsRenderHook::SIDEBAR_LOGO_BEFORE,
                fn () => view('filament.admin.components.brand'),
            )
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
                fn () => auth()->user()?->role === \App\Enums\UserRole::Admin
                    ? view('filament.admin.components.notification-bell')
                    : '',
            )
            ->renderHook(
                PanelsRenderHook::TOPBAR_START,
                fn () => view('filament.admin.components.topbar-logo'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\Filament\Admin\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\Filament\Admin\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
