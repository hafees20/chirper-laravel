<x-dropdown>
    <x-slot name="trigger">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 dark:text-gray-300" viewBox="0 0 20 20"
                fill="currentColor">
                <path
                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </button>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route('chirps.edit', $chirp)">
            {{ __('Edit') }}
        </x-dropdown-link>
        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
            @csrf
            @method('delete')
            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>
