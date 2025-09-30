<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user && in_array($user->role, ['admin', 'author', 'operator'])) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/');
    }
}
