<x-layouts.app>
    <div class="flex flex-col items-center justify-center min-h-screen text-center px-6">
        <h1 class="text-6xl font-bold text-red-600 mb-4">500</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
            Terjadi kesalahan pada server. Silakan coba lagi nanti.
        </p>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Kembali ke Beranda
        </a>
    </div>
</x-layouts.app>
