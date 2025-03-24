<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Apply theme early
        if (localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('theme-toggle');
            toggle?.addEventListener('click', () => {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        });
    </script>
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 sm:justify-center relative">

        <!-- Theme Toggle Button -->
        <button id="theme-toggle"
            class="absolute top-4 right-4 z-50 px-3 py-2 border rounded-md text-sm text-gray-700 bg-white border-gray-300 hover:bg-gray-200 dark:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition">
            🌓
        </button>

        <!-- Logo -->
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-300" />
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
