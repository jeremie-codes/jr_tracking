<?php

namespace App\Providers\Filament;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Enums\ThemeMode;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;

use App\Filament\Clusters\Monaie;
use App\Filament\Clusters\Personnel;
use App\Filament\Pages\MonRapport;
use App\Filament\Pages\AllEcriture;
use App\Filament\Pages\RapportParAgent;
use App\Filament\Resources\ProfilResource;
use App\Filament\Resources\ArticleResource;
use App\Filament\Resources\CommandeResource;
use App\Filament\Resources\IndicateurResource;
use App\Filament\Resources\CommandeAgentResource;
use App\Filament\Resources\ApprovisionnerAgentResource;
use App\Filament\Resources\VerifierRetraitResource;
use Illuminate\Support\Facades\Auth;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/')
            ->login()
            ->colors([
                'primary' => '#5499d3',
            ])
            ->defaultThemeMode(ThemeMode::Dark)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
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
            ])
            ->brandLogo(asset('assets/images/auth/shop-icon-b.png'))
            ->brandLogoHeight('60px')
            // ->topNavigation()
            ->favicon(asset('assets/images/auth/shop-icon.png'))
            // ->sidebarCollapsibleOnDesktopj()
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                if(Auth::user()->role === 'C-agent')
                {
                    return $builder->groups([
                        NavigationGroup::make('Accueil')
                            ->items([
                                ...Pages\Dashboard::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Option & Actions')
                            ->items([
                                ...AllEcriture::getNavigationItems(),
                                ...CommandeAgentResource::getNavigationItems(),
                                ...VerifierRetraitResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Rapports')
                            ->items([
                                ...MonRapport::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Configurations')
                            ->items([
                                ...ProfilResource::getNavigationItems(),
                            ]),
                    ]);
                } else {
                    return $builder->groups([
                        NavigationGroup::make('Accueil')
                            ->items([
                                ...Pages\Dashboard::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Option & Actions')
                            ->items([
                                ...AllEcriture::getNavigationItems(),
                                ...CommandeResource::getNavigationItems(),
                                ...ApprovisionnerAgentResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Rapports')
                            ->items([
                                ...MonRapport::getNavigationItems(),
                                ...RapportParAgent::getNavigationItems(),
                                ...IndicateurResource::getNavigationItems(),
                            ]),
                        NavigationGroup::make('Configurations')
                            ->items([
                                ...Monaie::getNavigationItems(),
                                ...Personnel::getNavigationItems(),
                                ...ArticleResource::getNavigationItems(),
                                ...ProfilResource::getNavigationItems(),
                            ]),
                    ]);
                }
            });

    }

}
