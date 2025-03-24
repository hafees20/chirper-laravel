<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 space-y-8">


        {{-- Profile Card --}}
        <div
            class="relative mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 px-6 pt-16 pb-6 text-center">

            {{-- Avatar --}}
            <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                <img src="https://i.pravatar.cc/150?u={{ $user->id }}" alt="Avatar"
                    class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border-4 border-white dark:border-gray-900 shadow-lg">
            </div>

            {{-- User Info --}}
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
            <p class="text-gray-500 dark:text-gray-400">{{ "@{$user->name}" }}</p>


            <p class="mt-3 text-gray-800 dark:text-gray-200">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. I’ll update this later with real bio.
            </p>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                📅 Joined {{ $user->created_at->format('F Y') }}
            </p>
        </div>

        {{-- Chirps --}}
        @if ($chirps->count())
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-700">
                @foreach ($chirps as $chirp)
                    <x-chirps.item :chirp="$chirp" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 text-center">No chirps yet.</p>
        @endif
    </div>
</x-app-layout>
