<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\AuditHelper;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        $eloquentUser = User::find($user->id);

        // Save old values for audit (without password)
        $oldValues = ['password' => '***'];

        // Update password
        $eloquentUser->password = Hash::make($request->new_password);
        $eloquentUser->save();

        // Save new values for audit (without raw password)
        $newValues = ['password' => '***'];

        // Log audit (event name could be 'password_changed' or similar)
        AuditHelper::logAudit('password_changed', $user, $oldValues, $newValues);

        return back()->with('success', 'Password updated successfully.');
    }

}
