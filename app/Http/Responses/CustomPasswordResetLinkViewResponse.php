<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;

class CustomPasswordResetLinkViewResponse implements RequestPasswordResetLinkViewResponse
{
    public function toResponse($request)
    {
        return response()->view('auth.forgot-password');
    }
}
