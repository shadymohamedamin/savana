<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse;
use App\Actions\Fortify\ConfirmPasswordView;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Http\Responses\ViewResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use App\Http\Responses\CustomPasswordResetLinkViewResponse;

use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use App\Http\Responses\CustomResetPasswordViewResponse;

class FortifyServiceProvider extends ServiceProvider
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

        Fortify::registerView(function () {
                return view('auth.register'); // adjust if using a different view or Inertia
            });

            $this->app->singleton(RegisterViewResponse::class, function () {
                return new class implements RegisterViewResponse {
                    public function toResponse($request)
                    {
                        return view('auth.register'); // or return Inertia::render('Auth/Register');
                    }
                };
            });


        
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        $this->app->singleton(RequestPasswordResetLinkViewResponse::class, CustomPasswordResetLinkViewResponse::class);
        $this->app->singleton(ResetPasswordViewResponse::class, CustomResetPasswordViewResponse::class);
        /*$this->app->singleton(
            \Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse::class,
            \Laravel\Fortify\Http\Responses\ViewResponse::class
        );

        $this->app->singleton(
            PasswordResetLinkSentResponse::class,
            \Laravel\Fortify\Http\Responses\PasswordResetLinkSentResponse::class
        );*/

        $this->app->singleton(
            FailedPasswordResetLinkRequestResponse::class,
            \Laravel\Fortify\Http\Responses\FailedPasswordResetLinkRequestResponse::class
        );

        $this->app->singleton(ConfirmPasswordViewResponse::class, ConfirmPasswordView::class);
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {

            $login = $request->email;

            $user = \App\Models\User::firstWhere('email', $request->email);//$user = \App\Models\User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])->first();
        //dd($user  . $login);
            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });
        //$this->app->singleton(ConfirmPasswordViewResponse::class, ConfirmPasswordView::class);

        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            function ($app) {
                return new class implements \Laravel\Fortify\Contracts\LoginResponse {
                    public function toResponse($request)
                    {
                        $user = $request->user();
                        if ($user && $user->two_factor_secret) {
                            // Redirect to 2FA challenge if 2FA is enabled
                            return redirect()->route('two-factor.login');
                        }
                        // Otherwise, normal redirect
                        return redirect()->intended(config('fortify.home'));
                    }
                };
            }
        );
        
        Fortify::loginView(function () {
            return view('auth.login'); // Make sure this view exists
        });
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge'); // Optional
        });
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
