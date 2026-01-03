<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Logs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-mono p-6">
    <h1 class="text-3xl mb-6 font-bold text-blue-300">Laravel Logs</h1>

    <div class="overflow-auto bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-700 text-left text-sm uppercase text-gray-300">
                <tr>
                    <th class="px-4 py-2">Date/Time</th>
                    <th class="px-4 py-2">Env</th>
                    <th class="px-4 py-2">Level</th>
                    <th class="px-4 py-2">Message</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="border-b border-gray-700 hover:bg-gray-600">
                        <td class="px-4 py-2 text-sm">{{ $log['timestamp'] }}</td>
                        <td class="px-4 py-2 text-sm">{{ $log['env'] }}</td>
                        <td class="px-4 py-2 text-sm text-{{ strtolower($log['level']) === 'error' ? 'red-400' : 'green-400' }}">{{ $log['level'] }}</td>
                        <td class="px-4 py-2 text-sm break-all">{{ $log['message'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-400">No logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->links('pagination::tailwind') }}
    </div>
</body>
</html>
