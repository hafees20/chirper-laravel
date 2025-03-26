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

<body <body
    class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <!-- Theme Toggle Button -->
    <button id="theme-toggle"
        class="absolute top-4 right-4 z-50 px-3 py-2 border rounded-md text-sm text-gray-700 bg-white border-gray-300 hover:bg-gray-200 dark:text-white dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 transition">
        🌓
    </button>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/chirps') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Chirps
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

        <main class="flex flex-col-reverse lg:flex-row w-full max-w-6xl mx-auto gap-8">
            <!-- Text Content -->
            <section class="flex-1 bg-white rounded-2xl shadow-xl p-8 md:p-12 dark:bg-neutral-800 ">
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold text-[#1DA1F2]">Welcome to Chirper</h1>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">
                        Stay connected and discover what's happening in the world – all in real-time.
                    </p>

                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Why join Chirper?</h2>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-4">
                                <div class="text-[#1DA1F2]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 6a8.1 8.1 0 0 1-2.34.64 4.07 4.07 0 0 0 1.79-2.25 8.16 8.16 0 0 1-2.6 1A4.07 4.07 0 0 0 12 8a11.54 11.54 0 0 1-8.39-4.25 4.07 4.07 0 0 0 1.26 5.43A4.04 4.04 0 0 1 3 8.27v.05a4.07 4.07 0 0 0 3.26 3.99 4.1 4.1 0 0 1-1.85.07 4.07 4.07 0 0 0 3.8 2.83A8.18 8.18 0 0 1 2 18.57a11.53 11.53 0 0 0 6.29 1.84c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.35-.01-.53A8.36 8.36 0 0 0 20 6z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">Post your thoughts in real-time.</p>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="text-[#1DA1F2]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0a12 12 0 1 0 12 12A12 12 0 0 0 12 0zm0 22a10 10 0 1 1 10-10 10 10 0 0 1-10 10zm5-10a5 5 0 0 1-5 5 1 1 0 0 1 0-2 3 3 0 0 0 3-3 1 1 0 0 1 2 0z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">Join trending conversations with ease.</p>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="text-[#1DA1F2]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 4a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2zm0 11a8 8 0 0 1-8-8 1 1 0 0 1 2 0 6 6 0 0 0 12 0 1 1 0 0 1 2 0 8 8 0 0 1-8 8z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300">Connect with people who inspire you.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('register') }}"
                            class="inline-block w-full text-center bg-[#1DA1F2] hover:bg-[#1A8CD8] text-white px-6 py-3 rounded-full font-medium transition">
                            Get Started
                        </a>
                    </div>
                </div>
            </section>

            <!-- Image/Graphics Section -->
            <aside
                class="flex-1 bg-white dark:bg-neutral-800 rounded-2xl shadow-xl p-8 flex flex-col justify-center items-center text-center">
                <!-- You can replace the SVG below with a modern illustration or image -->
                <div
                    class="w-32 h-32 bg-[#E8F5FD] dark:bg-[#1D2939] rounded-full flex items-center justify-center mb-6">
                    <svg class="w-16 h-16 text-[#1DA1F2]" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.6.59-2.46.7a4.26 4.26 0 0 0 1.88-2.36 8.52 8.52 0 0 1-2.71 1.04A4.24 4.24 0 0 0 11.2 8.03c0 .33.04.65.1.96A12.06 12.06 0 0 1 3.15 4.67a4.23 4.23 0 0 0-.58 2.13c0 1.47.75 2.77 1.88 3.53a4.2 4.2 0 0 1-1.92-.53v.06c0 2.05 1.46 3.76 3.4 4.15a4.3 4.3 0 0 1-1.91.07c.54 1.68 2.1 2.91 3.95 2.95a8.51 8.51 0 0 1-5.28 1.82A8.62 8.62 0 0 1 2 19.54a12.02 12.02 0 0 0 6.51 1.91c7.81 0 12.08-6.47 12.08-12.08l-.01-.55A8.55 8.55 0 0 0 24 4.56a8.3 8.3 0 0 1-2.38.65A4.25 4.25 0 0 0 22.46 6z" />
                    </svg>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-3">Join Chirper today</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-xs">
                    Be part of the conversation. Share your moments. Find your community.
                </p>
            </aside>
        </main>
    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
