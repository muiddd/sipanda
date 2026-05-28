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
            ->passwordReset()
            ->brandLogo(asset('images/logo.svg'))
            ->darkModeBrandLogo(asset('images/logo-white.svg'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => Color::Lime,
            ])
            ->renderHook(
                'panels::head.end',
                fn(): string => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        aside.fi-sidebar,
                        aside.fi-sidebar > div,
                        aside.fi-sidebar .fi-sidebar-header,
                        aside.fi-sidebar .fi-sidebar-nav {
                            background: transparent !important;
                        }
                        
                        aside.fi-sidebar {
                            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, #f7f6f0 50%, #effaf0 100%) !important;
                            backdrop-filter: blur(20px);
                            border-right: 1px solid rgba(0, 0, 0, 0.05) !important;
                        }

                        .dark aside.fi-sidebar {
                            background: linear-gradient(180deg, rgba(18, 18, 18, 0.95) 0%, #151d14 50%, #101410 100%) !important;
                            border-right: 1px solid rgba(255, 255, 255, 0.05) !important;
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
            ->renderHook(
                'panels::auth.login.form.after',
                fn(): string => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        .google-btn-container {
                            margin-top: 1.5rem;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 1rem;
                        }
                        .google-btn-divider {
                            position: relative;
                            width: 100%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .google-btn-line {
                            border-top: 1px solid #e5e7eb;
                            width: 100%;
                        }
                        .dark .google-btn-line {
                            border-top: 1px solid #374151;
                        }
                        .google-btn-text {
                            position: absolute;
                            background-color: #ffffff;
                            padding: 0 0.75rem;
                            font-size: 0.75rem;
                            color: #6b7280;
                        }
                        .dark .google-btn-text {
                            background-color: #09090b; /* zinc-950/900 matching */
                            color: #9ca3af;
                        }
                        .google-btn {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 0.75rem;
                            width: 100%;
                            padding: 0.625rem 1rem;
                            border: 1px solid #d1d5db;
                            border-radius: 0.75rem;
                            background-color: #ffffff;
                            color: #374151;
                            font-weight: 600;
                            font-size: 0.875rem;
                            text-decoration: none;
                            transition: all 0.2s ease;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                        }
                        .dark .google-btn {
                            background-color: #18181b; /* zinc-900 */
                            border-color: #27272a; /* zinc-800 */
                            color: #e4e4e7; /* zinc-200 */
                        }
                        .google-btn:hover {
                            background-color: #f9fafb;
                            border-color: #9ca3af;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                        }
                        .dark .google-btn:hover {
                            background-color: #27272a; /* zinc-800 */
                            border-color: #3f3f46; /* zinc-700 */
                        }
                    </style>
                    <div class="google-btn-container">
                        <div class="google-btn-divider">
                            <div class="google-btn-line"></div>
                            <span class="google-btn-text">Atau masuk dengan</span>
                        </div>

                        <a href="{{ route(\'auth.google\') }}" class="google-btn">
                            <svg style="width: 1.25rem; height: 1.25rem;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                            </svg>
                            <span>Google</span>
                        </a>
                    </div>
                '),
            )
            ->renderHook(
                'panels::auth.register.form.after',
                fn(): string => \Illuminate\Support\Facades\Blade::render('
                    <style>
                        .google-btn-container {
                            margin-top: 1.5rem;
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 1rem;
                        }
                        .google-btn-divider {
                            position: relative;
                            width: 100%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .google-btn-line {
                            border-top: 1px solid #e5e7eb;
                            width: 100%;
                        }
                        .dark .google-btn-line {
                            border-top: 1px solid #374151;
                        }
                        .google-btn-text {
                            position: absolute;
                            background-color: #ffffff;
                            padding: 0 0.75rem;
                            font-size: 0.75rem;
                            color: #6b7280;
                        }
                        .dark .google-btn-text {
                            background-color: #09090b;
                            color: #9ca3af;
                        }
                        .google-btn {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 0.75rem;
                            width: 100%;
                            padding: 0.625rem 1rem;
                            border: 1px solid #d1d5db;
                            border-radius: 0.75rem;
                            background-color: #ffffff;
                            color: #374151;
                            font-weight: 600;
                            font-size: 0.875rem;
                            text-decoration: none;
                            transition: all 0.2s ease;
                            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                        }
                        .dark .google-btn {
                            background-color: #18181b;
                            border-color: #27272a;
                            color: #e4e4e7;
                        }
                        .google-btn:hover {
                            background-color: #f9fafb;
                            border-color: #9ca3af;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                        }
                        .dark .google-btn:hover {
                            background-color: #27272a;
                            border-color: #3f3f46;
                        }
                    </style>
                    <div class="google-btn-container">
                        <div class="google-btn-divider">
                            <div class="google-btn-line"></div>
                            <span class="google-btn-text">Atau daftar dengan</span>
                        </div>

                        <a href="{{ route(\'auth.google\') }}" class="google-btn">
                            <svg style="width: 1.25rem; height: 1.25rem;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                            </svg>
                            <span>Google</span>
                        </a>
                    </div>
                '),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
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
