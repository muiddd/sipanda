<?php

namespace App\Providers\Filament;

use App\Http\Middleware\RedirectLogin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('sipanda')
            ->login()
            ->registration(\App\Filament\Pages\Auth\CustomRegister::class)
            ->brandLogo(asset('images/logo.svg')) 
            ->darkModeBrandLogo(asset('images/logo-white.svg'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => Color::Lime,
            ])
            ->renderHook(
                'panels::head.end',
                fn (): string => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        aside.fi-sidebar {
                            background: linear-gradient(180deg, rgba(255, 255, 255, 0.8) 0%, #f2f1e8 40%, #e8f5e5 100%) !important;
                            backdrop-filter: blur(20px);
                            border-right: 1px solid rgba(255, 255, 255, 0.5);
                        }

                        .fi-sidebar-item-active a {
                            background-color: #75cb50 !important;
                            color: white !important;
                            border-radius: 0.5rem;
                            margin-inline: 0.5rem;
                            box-shadow: 0 4px 12px rgba(117, 203, 80, 0.35);
                        }
                        
                        .fi-sidebar-item-active a svg {
                            color: white !important;
                        }
                    </style>
                '),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                RedirectLogin::class,
            ]);
    }
}
