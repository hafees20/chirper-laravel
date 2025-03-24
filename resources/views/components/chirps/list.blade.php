<div class="mt-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-700">
    @foreach ($chirps as $chirp)
        <x-chirps.item :chirp="$chirp" />
    @endforeach
</div>
