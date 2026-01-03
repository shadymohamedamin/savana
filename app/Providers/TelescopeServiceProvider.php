<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

Telescope::auth(function ($request) {
    return in_array($request->user()->email, ['it@rakcharity.ae',])&& auth()->user()->is_admin;
});




//return auth()->check() && auth()->user()->is_admin;
//Telescope::auth(function ($request) {
//    return $request->ip() === 'your.ip.address';
//});




//🧹 6. Optional: Clean Up Old Telescope Data

//In app/Console/Kernel.php, add:

//$schedule->command('telescope:prune')->daily();

//And set this in .env to delete logs after 24 hours:

//TELESCOPE_PRUNE_DAYS=1



// 🚫 1. Remove Telescope Package

// Run:

// composer remove laravel/telescope

// 🧼 2. Remove Telescope Files

// Delete:

//     TelescopeServiceProvider.php (in app/Providers)

//     Any Telescope configs:

//     rm config/telescope.php

// 🧹 3. Remove Telescope Database Tables

// Option 1: Manually delete telescope tables in phpMyAdmin (like telescope_entries, telescope_entries_tags, etc)

// Option 2: Run this if you're sure:

// php artisan migrate:rollback



class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();

        $isLocal = $this->app->environment('local');

        Telescope::filter(function (IncomingEntry $entry) use ($isLocal) {
            return $isLocal ||
                   $entry->isReportableException() ||
                   $entry->isFailedRequest() ||
                   $entry->isFailedJob() ||
                   $entry->isScheduledTask() ||
                   $entry->hasMonitoredTag();
        });
    }

    /**
     * Prevent sensitive request details from being logged by Telescope.
     */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }
}
