<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next)
        {
            if (auth()->check() && auth()->user()->lang) {
                App::setLocale(auth()->user()->lang);
            } elseif (session()->has('lang')) {
                App::setLocale(session('lang'));
            } else {
                App::setLocale(config('app.locale'));
            }

            return $next($request);
        }



}
