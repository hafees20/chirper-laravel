


<x-app-layout>
    <div class="container mx-auto max-w-xl py-10">
        <h1 class="text-3xl font-bold mb-4">Welcome back, {{ Auth::user()->name }} 👋</h1>
        <p class="text-lg text-gray-700 mb-6">
            You're logged in! Head over to the <a href="{{ route('chirps.index') }}" class="text-blue-500 hover:underline">Chirps</a> tab to start chirping.
        </p>
        <a href="{{ route('chirps.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Go to Chirps →
        </a>
    </div>
</x-app-layout>

