<?php

namespace Cryocaustik\SeatHr;

use Cryocaustik\SeatHr\http\composers\Profile;
use Cryocaustik\SeatHr\http\composers\ProfileMenu;
use Cryocaustik\SeatHr\http\composers\Review;
use Cryocaustik\SeatHr\http\composers\ReviewMenu;
use Seat\Services\AbstractSeatPlugin;


class SeatHrServiceProvider extends AbstractSeatPlugin
{
    public $app;
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'seat-hr');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'seat-hr');
        $this->loadViewComposers();

    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/config/seat-hr.config.php', 'seat-hr');
        $this->mergeConfigFrom(__DIR__ . '/config/seat-hr.sidebar.php', 'package.sidebar');
        $this->mergeConfigFrom(__DIR__ . '/config/seat-hr.profile.menu.php', 'seat-hr.profile.menu');
        $this->mergeConfigFrom(__DIR__ . '/config/seat-hr.review.menu.php', 'seat-hr.review.menu');
        $this->mergeConfigFrom(__DIR__ . '/config/package.character.menu.php', 'package.character.menu');
        $this->registerPermissions(__DIR__ . '/config/seat-hr.permissions.php', 'seat-hr');


        // Register the main class to use with the facade
        $this->app->singleton('seat-hr', fn(): \Cryocaustik\SeatHr\SeatHr => new SeatHr);
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @return string
     * @example SeAT Web
     *
     */
    public function getName(): string
    {
        return 'SeAT Human Resources';
    }

    /**
     * Return the plugin repository address.
     *
     * @example https://github.com/eveseat/web
     *
     * @return string
     */
    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/cryocaustik/seat-hr';
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @return string
     * @example web
     *
     */
    public function getPackagistPackageName(): string
    {
        return 'seat-hr';
    }

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @return string
     * @example eveseat
     *
     */
    public function getPackagistVendorName(): string
    {
        return 'cryocaustik';
    }

    /**
     * Loads view composers to reuse data within views
     */
    private function loadViewComposers(): void
    {
        $this->app['view']->composer('seat-hr::user.*', Profile::class);
        $this->app['view']->composer('seat-hr::review.*', Review::class);

        $this->app['view']->composer('seat-hr::user.includes.menu', ProfileMenu::class);
        $this->app['view']->composer('seat-hr::review.includes.menu', ReviewMenu::class);
    }
}
