<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse;
use Illuminate\Contracts\Support\Responsable;

class ConfirmPasswordView implements ConfirmPasswordViewResponse, Responsable
{
    public function toResponse($request)
    {
        return view('auth.confirm-password'); // You must also create this Blade view
    }
}
