<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chirper</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Check localStorage and apply dark class early to avoid flash
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

<body
    class="bg-[#F0F2F5] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <!-- Theme Toggle Button -->
    <button id="theme-toggle"
        class="absolute top-4 right-4 z-50 px-3 py-2 border rounded-md text-sm text-gray-700 bg-white border-gray-300 hover:bg-gray-200 dark:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition">
        🌓
    </button>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row gap-8">
            <!-- Text Content -->
            <div class="flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-lg rounded-lg">
                <div class="space-y-6">
                    <h1 class="text-3xl font-bold text-[#1DA1F2]">Welcome to Chirper</h1>
                    <p class="text-lg text-[#536471] dark:text-[#8b98a5]">
                        Connect with your friends and the world around you on Chirper.
                    </p>

                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold">What's happening?</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">

                                <svg class="w-6 h-6 text-[#1DA1F2]" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 6a8.1 8.1 0 0 1-2.34.64 4.07 4.07 0 0 0 1.79-2.25 8.16 8.16 0 0 1-2.6 1A4.07 4.07 0 0 0 12 8a11.54 11.54 0 0 1-8.39-4.25 4.07 4.07 0 0 0 1.26 5.43A4.04 4.04 0 0 1 3 8.27v.05a4.07 4.07 0 0 0 3.26 3.99 4.1 4.1 0 0 1-1.85.07 4.07 4.07 0 0 0 3.8 2.83A8.18 8.18 0 0 1 2 18.57a11.53 11.53 0 0 0 6.29 1.84c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.35-.01-.53A8.36 8.36 0 0 0 20 6z" />
                                </svg>
                                <span>Share your thoughts in real-time</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-[#1DA1F2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0a12 12 0 1 0 12 12A12 12 0 0 0 12 0zm0 22a10 10 0 1 1 10-10 10 10 0 0 1-10 10zm5-10a5 5 0 0 1-5 5 1 1 0 0 1 0-2 3 3 0 0 0 3-3 1 1 0 0 1 2 0z" />
                                </svg>
                                <span>Join trending conversations</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-[#1DA1F2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 4a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2zm0 11a8 8 0 0 1-8-8 1 1 0 0 1 2 0 6 6 0 0 0 12 0 1 1 0 0 1 2 0 8 8 0 0 1-8 8z" />
                                </svg>
                                <span>Follow interesting people</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('register') }}"
                            class="inline-block w-full text-center bg-[#1DA1F2] hover:bg-[#1a8cd8] text-white px-8 py-3 rounded-full font-medium transition-colors">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Image/Graphics Section -->
            <div class="bg-[#E8F5FE] dark:bg-[#192734] rounded-lg lg:w-1/2 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="text-[#1DA1F2] text-6xl mb-4">🐦</div>

                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-200">Join Chirper today</h2>
                    <p class="text-[#536471] dark:text-[#8b98a5]">
                        Be part of the conversation. Share your moments. Connect with others.
                    </p>
                </div>
            </div>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
