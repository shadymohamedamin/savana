<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LogViewerController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');

        if (!File::exists($logFile)) {
            return view('logs.index', ['logs' => [], 'paginator' => null]);
        }

        $lines = explode("\n", File::get($logFile));
        $entries = [];

        foreach ($lines as $line) {
            if (preg_match('/^\[(.*?)\] (\w+)\.(\w+): (.*)/', $line, $matches)) {
                $entries[] = [
                    'timestamp' => $matches[1],
                    'env'       => $matches[2],
                    'level'     => strtoupper($matches[3]),
                    'message'   => $matches[4],
                ];
            }
        }

        $entries = array_reverse($entries); // Show newest first

        // Paginate
        $currentPage = request()->get('page', 1);
        $perPage = 20;
        $logsCollection = collect($entries);
        $pagedData = new LengthAwarePaginator(
            $logsCollection->forPage($currentPage, $perPage),
            $logsCollection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('logs.index', ['logs' => $pagedData]);
    }
}
