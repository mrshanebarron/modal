<?php

namespace MrShaneBarron\Modal;

use Illuminate\Support\ServiceProvider;

class ModalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modal.php', 'sb-modal');
    }

    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-modal', Livewire\Modal::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-modal');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/modal.php' => config_path('sb-modal.php'),
            ], 'sb-modal-config');
        }
    }
}
