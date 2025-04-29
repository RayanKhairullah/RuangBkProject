<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    protected function registerPolicies(): void
    {
        // Register your policies here if needed
    }
    public function boot(): void
    {
        $this->registerPolicies();
        Blade::componentNamespace('App\\View\\Components', 'components');
    }
}
