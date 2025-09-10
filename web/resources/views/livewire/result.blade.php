<x-layouts.app>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 text-center">
            
            <!-- Icon Success -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full bg-green-100 dark:bg-green-900 mb-6">
                <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <!-- Pesan -->
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                Terima Kasih!
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Suara kamu berhasil direkam
            </p>

            <!-- Tombol -->
            <div class="flex flex-col space-y-3">

                <a href="{{ route('voter.index') }}" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition duration-300">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
