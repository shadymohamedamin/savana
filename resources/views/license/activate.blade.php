@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white rounded-2xl shadow-lg p-10 w-full max-w-md text-center space-y-6">
        <div>
            <h2 class="text-3xl font-bold text-blue-700 mb-2">🔐 Activate License</h2>
            <p class="text-sm text-gray-500">Enter the password and activation date.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded-md text-sm text-left">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('license.activate') }}" class="space-y-5 flex justify-center align-center">
            {{-- Hidden input for license key --}}
            {{-- CSRF Token --}}
            @csrf

            <div class="my-2">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">🔑 Confirm Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full  px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="my-2">
                <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-1">📅 Valid Until</label>
                <input type="date" name="valid_until" id="valid_until" required
                       class="w-full  px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit my-2"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg shadow-md transition duration-200">
                ✅ Activate License
            </button>
        </form>
    </div>
</div>
@endsection
