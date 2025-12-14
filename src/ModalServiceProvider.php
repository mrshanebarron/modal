<?php

namespace MrShaneBarron\Modal;

use Illuminate\Support\ServiceProvider;

class ModalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modal.php', 'ld-modal');
    }

    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('ld-modal', Livewire\Modal::class);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-modal');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/modal.php' => config_path('ld-modal.php'),
            ], 'ld-modal-config');
        }
    }
}
