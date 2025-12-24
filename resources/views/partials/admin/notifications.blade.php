{{-- Success Notification --}}
@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-6 rounded-xl border border-success-500 bg-success-50 p-4 dark:border-success-500/30 dark:bg-success-500/15">
        <div class="flex items-start gap-3">
            <div class="-mt-0.5 text-success-500">
                <i class="fa-solid fa-circle-check text-2xl"></i>
            </div>
            <div class="flex-1">
                <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Berhasil!</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
    </div>
@endif

{{-- Error Notification --}}
@if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-6 rounded-xl border border-error-500 bg-error-50 p-4 dark:border-error-500/30 dark:bg-error-500/15">
        <div class="flex items-start gap-3">
            <div class="-mt-0.5 text-error-500">
                <i class="fa-solid fa-circle-exclamation text-2xl"></i>
            </div>
            <div class="flex-1">
                <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90">Gagal!</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ session('error') }}</p>
            </div>
            <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
    </div>
@endif