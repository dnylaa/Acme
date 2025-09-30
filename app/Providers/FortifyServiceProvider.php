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
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Illuminate\Support\Facades\Auth;



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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        
        //login
        Fortify::loginView(function(){
        return view('auth.login');	//return view menggunakan blade 
        });	

        $this->app->singleton(
    \Laravel\Fortify\Contracts\LoginResponse::class,
    \App\Http\Responses\LoginResponse::class
);


        //logout
        $this->app->singleton(\Laravel\Fortify\Contracts\LogoutResponse::class,
        \App\Http\Responses\LogoutResponse::class);

        //Register
        Fortify::registerView(function () {
            return view('auth.register');
        });

    
        // Login dan Register views
    Fortify::loginView(fn() => view('auth.login'));
    Fortify::registerView(fn() => view('auth.register'));

    // Binding untuk forgot password view
    $this->app->singleton(RequestPasswordResetLinkViewResponse::class, function ($app) {
        return new class implements RequestPasswordResetLinkViewResponse {
            public function toResponse($request)
            {
                return response()->view('auth.forgot-password');
            }
        };
    });

    // Binding untuk reset password view
    $this->app->singleton(ResetPasswordViewResponse::class, function ($app) {
        return new class implements ResetPasswordViewResponse {
            public function toResponse($request)
            {
                return response()->view('auth.reset-password', [
                    'request' => $request,
                ]);
            }
        };
    });
    
    }
    
}
