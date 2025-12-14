<?php

namespace MrShaneBarron\Modal;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class ModalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-modal.php', 'ld-modal');
    }

    public function boot(): void
    {
        Livewire::component('ld-modal', Livewire\Modal::class);
        $this->loadViewComponentsAs('ld', [View\Components\Modal::class]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-modal');

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/ld-modal.php' => config_path('ld-modal.php')], 'ld-modal-config');
            $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/vendor/ld-modal')], 'ld-modal-views');
        }
    }
}
