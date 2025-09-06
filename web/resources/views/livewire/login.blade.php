<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-sm p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M17 16h.01"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Ikuti Vote</h1>
            <p class="text-gray-500 dark:text-gray-400">Masukkan token yang Anda miliki untuk berpartisipasi.</p>
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label for="token" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Token Vote</label>
                <input type="text" id="token" wire:model="token"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white placeholder-gray-400"
                    placeholder="Contoh: ABCD-1234" />
                @error('token') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="mt-4 w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition duration-300">
                Lanjut
            </button>
        </form>
    </div>
</div>