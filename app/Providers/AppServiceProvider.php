<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\CurrencyHelper;
use App\Helpers\JalaliHelper;

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
        
        // Register Jalali date helper as Blade directive
        Blade::directive('jalali', function ($expression) {
            return "<?php echo App\Helpers\JalaliHelper::format($expression); ?>";
        });
    }
}