<?php

namespace App\Modules\HR\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class HRServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'hr');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'hr');

        Blade::componentNamespace('App\\Modules\\HR\\View\\Components', 'hr');
    }

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
                $key = 'hr.'.str_replace(['/', '.php'], ['.', ''], $relative);
                $this->mergeConfigFrom($file->getPathname(), $key);
            }
        }
    }
}
