<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Helpers\AuditHelper;

class LicenseController extends Controller
{
    /*public function __construct()
    {
        $this->middleware(['auth', 'admin']); // Create admin middleware if needed
    }*/
    private $knownKey = 'rak@1234';
    private $hashedPassword = '$2y$12$xdJIpsTT6rVJjHAhwJm0wOPWlCA2hsVSTwiDozDGvRu7e5x55vBJ6';//rak@1234

    public function form()
    {
        return view('license.activate');
    }

    public function activate(Request $request)
    {
        if (!in_array(auth()->user()->role_id, [1])) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'ليس لديك الصلاحيات الكافية'
            ]);
        }
        $request->validate([
            'password' => 'required|string',
            'valid_until' => 'required|date|after:now',
        ]);

        if (!Hash::check($request->password, $this->hashedPassword)) {
            return back()->withErrors(['password' => '❌ Invalid password']);
        }

        $license = [
            'key' => $this->knownKey,
            'valid_until' => $request->valid_until,
            'domain' => parse_url(config('app.url'), PHP_URL_HOST) ?? 'localhost',
        ];

        File::put(storage_path('app/license.key'), Crypt::encryptString(json_encode($license)));

        AuditHelper::logAudit(
            'activated',
            'activation',
            $license,
            newValues: []
        );

        /*\Mail::raw("🔐 The website was activated until {$license['valid_until']}.", function ($message) {
            $message->to('it@rakcharity.ae')
                    ->subject('✅ Website License Activated');
        });*/
        return back()->with('success', '✅ License activated until ' . $request->valid_until);
    }
}

