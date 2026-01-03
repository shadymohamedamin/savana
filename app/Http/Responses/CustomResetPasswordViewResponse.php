<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\ResetPasswordViewResponse;

class CustomResetPasswordViewResponse implements ResetPasswordViewResponse
{
    public function toResponse($request)
    {
        return response()->view('auth.reset-password', [
            'request' => $request,
            'token' => $request->route('token'), 
            'email' => $request->email, 
        ]);
    }
}
