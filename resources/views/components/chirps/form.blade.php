<form method="POST" action="{{ route('chirps.store') }}" enctype="multipart/form-data"
    class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-md border border-gray-200 dark:border-gray-700">
    @csrf

    <div class="flex items-start space-x-4">
        <!-- User Avatar -->
        <img src="https://i.pravatar.cc/48?u={{ auth()->id() }}" alt="avatar" class="w-12 h-12 rounded-full">

        <div class="flex-1">
            <!-- Textarea -->
            <textarea name="message" rows="3" placeholder="{{ __('What\'s on your mind?') }}"
                class="w-full resize-none text-lg bg-transparent border-none focus:ring-0 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400">{{ old('message') }}</textarea>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />

            <!-- Image Preview -->
            <div id="image-preview-container" class="relative mt-4 hidden">
                <img id="image-preview" src="" alt="Preview"
                    class="max-h-60 rounded-xl border border-gray-300 dark:border-gray-600 shadow-md" />
                <button type="button" id="remove-image"
                    class="absolute top-1 right-1 bg-black/70 text-white rounded-full p-1 hover:bg-black transition">
                    ✕
                </button>
            </div>

            <!-- Bottom Controls -->
            <div class="flex justify-between items-center mt-4">
                <!-- File Upload -->
                <label for="image-upload"
                    class="cursor-pointer flex items-center text-sm text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 16l4-4a2 2 0 012.828 0L14 16l4-4a2 2 0 012.828 0L21 16m-3 4H6a2 2 0 01-2-2V6a2 2 0 012-2h6" />
                    </svg>
                    Add image
                </label>

                <input type="file" id="image-upload" name="image" accept="image/*" class="hidden" />
                <!-- Chirp Button -->
                <x-primary-button class="ml-auto px-6 py-2 text-sm">{{ __('Chirp') }}</x-primary-button>
            </div>
        </div>
    </div>
</form>
<!-- client side -->
<div id="image-error-toast"
    class="hidden mt-4 mx-auto max-w-md bg-red-500 text-white px-4 py-3 rounded-lg shadow-md text-sm"></div>


<!-- server side -->
@if ($errors->has('image'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition
        class="mt-4 mx-auto max-w-md flex items-center justify-between gap-4 bg-red-500 text-white px-4 py-3 rounded-lg shadow-md">
        <span>{{ $errors->first('image') }}</span>
        <button @click="show = false" class="text-white hover:text-gray-200 focus:outline-none text-xl leading-none">
            &times;
        </button>
    </div>
@endif

<script>
    const imageInput = document.getElementById('image-upload');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');
    const removeBtn = document.getElementById('remove-image');

    // Toast container
    const toastContainer = document.getElementById('image-error-toast');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        // Validate type
        if (!allowedTypes.includes(file.type)) {
            showToast('Invalid file type. Please upload a JPG, PNG, GIF, or WEBP image.');
            clearPreview();
            return;
        }

        // Validate size
        if (file.size > maxSize) {
            showToast('File size must be under 2MB.');
            clearPreview();
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    removeBtn.addEventListener('click', function() {
        clearPreview();
    });

    function clearPreview() {
        imageInput.value = '';
        previewImage.src = '';
        previewContainer.classList.add('hidden');
    }

    function showToast(message) {
        if (toastContainer) {
            toastContainer.innerText = message;
            toastContainer.classList.remove('hidden');

            setTimeout(() => {
                toastContainer.classList.add('hidden');
            }, 2000);
        }
    }
</script>
