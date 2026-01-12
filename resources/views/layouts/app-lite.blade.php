@php($title = $title ?? config('app.name'))
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <a href="{{ url('/') }}" class="font-bold text-lg">{{ config('app.name') }}</a>
                <div class="space-x-4">
                    <a href="{{ route('pricing') }}" class="text-sm text-gray-700">Pricing</a>
                    <a href="{{ route('templates.index') }}" class="text-sm text-gray-700">Templates</a>
                    @auth
                        <a href="{{ route('resumes.index') }}" class="text-sm text-gray-700">Resumes</a>
                        <a href="{{ route('portfolios.index') }}" class="text-sm text-gray-700">Portfolios</a>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-700">Dashboard</a>
                    @endauth
                </div>
            </div>
        </nav>

        @if (session('status'))
            <div class="bg-emerald-50 border-l-4 border-emerald-400 text-emerald-800 p-4">
                <div class="max-w-7xl mx-auto px-4">{{ session('status') }}</div>
            </div>
        @endif

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
