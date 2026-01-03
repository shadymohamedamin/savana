<?php
//sudo php artisan license:activate key 1
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class ActivateLicense extends Command
{
    protected $signature = 'license:activate {key} {interval=weekly}';
    protected $description = 'Manually activate the Laravel application license';

    public function handle()
    {
        if (!app()->runningInConsole()) {
            echo "❌ This command must be run in the console.\n";
            return;
        }

        $key = $this->argument('key');
        $interval = $this->argument('interval');

        $validUntil = match ($interval) {
            'daily' => now()->addDay(),
            'weekly' => now()->addWeek(),
            'monthly' => now()->addMonth(),
            'yearly' => now()->addYear(),
            default => now()->addMinutes((int) $interval),
        };

        $license = [
            'key' => $key,
            'valid_until' => $validUntil->format('Y-m-d H:i:s'),
            'domain' => parse_url(config('app.url'), PHP_URL_HOST) ?? 'localhost',
        ];

        File::put(storage_path('app/license.key'), Crypt::encryptString(json_encode($license)));

        echo "✅ License activated until {$license['valid_until']}.\n";
    }


}