<div class="p-6 flex space-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-300 -scale-x-100" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('user.profile', $chirp->user->name) }}"
                    class="text-gray-800 dark:text-gray-100 font-semibold hover:underline">{{ $chirp->user->name }}</a>
                <small class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ $chirp->created_at->format('j M Y, g:i a') }}
                </small>
                @unless ($chirp->created_at->eq($chirp->updated_at))
                    <small class="text-sm text-gray-600 dark:text-gray-400">
                        &middot; {{ __('edited') }}
                    </small>
                @endunless
            </div>
            @if ($chirp->user->is(auth()->user()))
                <x-chirps.dropdown :chirp="$chirp" />
            @endif
        </div>

        {{-- Message --}}
        <p class="mt-4 text-lg text-gray-900 dark:text-gray-100">{{ $chirp->message }}</p>

        {{-- Image (if available) --}}
        @if ($chirp->image)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $chirp->image) }}" alt="Chirp image"
                    class="rounded-xl border border-gray-300 dark:border-gray-700 max-h-96 shadow-md w-full object-cover">
            </div>
        @endif
        {{-- Actions --}}
        <div class="mt-4 flex space-x-4">
            <!-- Like Button -->



            <div x-data="{
                liked: {{ json_encode($chirp->isLikedBy(auth()->user())) }},
                count: {{ $chirp->likes()->count() }},
                async toggleLike() {
                    const res = await fetch('/chirps/{{ $chirp->id }}/like', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    this.liked = data.liked;
                    this.count = data.count;
                }
            }">
                <button @click="toggleLike"
                    :class="liked ? 'bg-pink-200 dark:bg-pink-800 text-pink-700 dark:text-pink-300' :
                        'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
                    class="flex items-center px-3 py-1.5 hover:bg-pink-100 dark:hover:bg-pink-900 hover:text-pink-600 dark:hover:text-pink-400 rounded-full transition-all shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'fill-current': liked }" class="h-5 w-5 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 015.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                    </svg>
                    <!--<span x-text="liked ? 'Liked' : 'Like'"></span>-->
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400" x-text="count"></span>
                </button>
            </div>

            <!-- Share Button -->
            <button
                onclick="navigator.share ? navigator.share({ url: window.location.href }) : alert('Sharing not supported')"
                class="flex items-center px-3 py-1.5 bg-gray-100 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-900 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-full transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 12v.01M12 4v.01M20 12v.01M12 20v.01M7.05 7.05v.01M16.95 7.05v.01M16.95 16.95v.01M7.05 16.95v.01" />
                </svg>
                <span>Share</span>
            </button>
        </div>

    </div>
</div>
