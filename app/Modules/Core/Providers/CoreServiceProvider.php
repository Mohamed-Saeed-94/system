<?php

namespace App\Modules\Core\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'core');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'core');

        Blade::componentNamespace('App\\Modules\\Core\\View\\Components', 'core');
    }

    /**
     * Merge all module configs recursively.
     */
    protected function registerConfig(): void
    {
        $configPath = __DIR__.'/../config';

        if (! is_dir($configPath)) {
            return;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relative = str_replace($configPath.DIRECTORY_SEPARATOR, '', $file->getPathname());
                $key = 'core.'.str_replace(['/', '.php'], ['.', ''], $relative);
                $this->mergeConfigFrom($file->getPathname(), $key);
            }
        }
    }
}
