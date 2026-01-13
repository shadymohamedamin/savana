<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Telescope\Telescope;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Auditor;
use Illuminate\Support\Facades\URL;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;


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
        

        Paginator::useBootstrap();


        view()->composer('*', function ($view) {

        if (!Auth::check()) return;

        // $expiringAttachments = Attachment::where('attachable_type', \App\Models\User::class)
        //         ->where('attachable_id', Auth::id())
        //         ->whereNotNull('expiration_date')
        //         ->whereBetween('expiration_date', [
        //             now(),
        //             now()->addDays(10)
        //         ])
        //         ->orderBy('expiration_date')
        //         ->get();

        //     $view->with('expiringAttachments', $expiringAttachments);
        // });



        $expiringAttachments = Attachment::where('attachable_type', \App\Models\User::class)
            ->where('attachable_id', Auth::id())
            ->whereNotNull('expiration_date')
            ->whereDate('expiration_date', '<=', now()->addDays(10))
            ->orderBy('expiration_date')
            ->get();

            $view->with('expiringAttachments', $expiringAttachments);

        });

                //if (env('APP_ENV') !== 'local') {
                //    URL::forceScheme('https');
                //}
        // Audit::creating(function ($audit) {
        //     dd('Creating audit record:', $audit->toArray());
        //     if (!$audit->user_id) {
        //         $audit->user_id = 1; // fallback if no logged-in user
        //     }
        // });
        //Audit::created(function ($audit) {
         //   Log::info('Audit record created:', $audit->toArray());
        //});

        /*if (app()->environment('production')) {
            Request::setTrustedProxies(
                [ // you can use ['0.0.0.0/0'] or '*' to trust all proxies
                    '*'
                ],
                Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO
            );
        }

        // Inline function to get the real IP from headers or fallback to request IP
        $getRealIp = function (Request $request) {
            $headers = [
                'X-Forwarded-For',
                'X-Real-IP',
                'CF-Connecting-IP',
                'True-Client-IP',
                'Forwarded',
            ];

            foreach ($headers as $header) {
                if ($ip = $request->header($header)) {
                    // Sometimes multiple IPs separated by commas, take first one
                    return trim(explode(',', $ip)[0]);
                }
            }

            return $request->ip();
        };

        Telescope::tag(function ($entry) use ($getRealIp) {
            if ($entry->type === 'request') {
                $ip = $getRealIp(request());
                return ['ip:' . $ip];
            }
            return [];
        });
        /*Telescope::tag(function ($entry) {
            if ($entry->type === 'request' && request()) {
                return ['ip:' . request()->ip()];
            }

            return [];
        });*/
        //
    }
}
