<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\CurrencyHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register currency helper as Blade directive
        Blade::directive('currency', function ($expression) {
            return "<?php echo App\Helpers\CurrencyHelper::format($expression); ?>";
        });
    }
}