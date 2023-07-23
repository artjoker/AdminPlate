<?php

namespace App\Providers;

use App\Infrastructure\Menu\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('Menu', function () {
            return new Menu();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @param  UrlGenerator $url
     * @return void
     */
    public function boot(UrlGenerator $url): void
    {
        Paginator::useBootstrap();

        if ($this->app->environment(['production'])) {
            $url->forceScheme('https');
        }

        Builder::macro('whereLike', function (string $attribute, string $searchTerm) {
            /* @phpstan-ignore-next-line  */
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });
    }
}
