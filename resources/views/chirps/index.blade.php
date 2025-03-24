<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <x-chirps.form />
        <x-chirps.list :chirps="$chirps" />
        <div class="mt-6">
            {{ $chirps->links() }}
        </div>
    </div>
</x-app-layout>
