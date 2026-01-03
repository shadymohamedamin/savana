<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class LicenseCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $excludedPaths = [
            'login',
            'login/*',
            'password/*',
            'activate-license',
            'two-factor-challenge',
            'logout',
            'logout/*',
        ];

        if ($request->is($excludedPaths)) {
            return $next($request);
        }
        \Log::info('Request path: ' . $request->path());
        \Log::info('Route name: ' . optional($request->route())->getName());

        try {
            if (!File::exists(storage_path('app/license.key'))) {
                abort(403, '🔒 License file not found.');
            }

            $licenseData = json_decode(
                Crypt::decryptString(File::get(storage_path('app/license.key'))),
                true
            );

            if (!isset($licenseData['valid_until'])) {
                abort(403, '🔒 License invalid: no expiry date.');
            }

            if (now()->greaterThan($licenseData['valid_until'])) {
                abort(403, '🔒 License expired.');
            }

            // Optional: Check domain if needed
            // $currentDomain = parse_url(config('app.url'), PHP_URL_HOST);
            // if ($licenseData['domain'] !== $currentDomain) {
            //     abort(403, '🔒 Domain mismatch.');
            // }

        } catch (\Exception $e) {
            abort(403, '🔒 Invalid license. Please contact support.');
        }

        return $next($request);
    }
}
