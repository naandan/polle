<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-6xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="/icon.png" alt="logo" class="w-14 h-14">
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <a href="{{ route('terms') }}"
                       class="me-4 md:me-6 hover:underline
                       {{ request()->routeIs('terms') ? 'text-blue-600 dark:text-blue-400 font-semibold underline' : '' }}">
                        Syarat dan Ketentuan
                    </a>
                </li>
                <li>
                    <a href="{{ route('privacy') }}"
                       class="me-4 md:me-6 hover:underline
                       {{ request()->routeIs('privacy') ? 'text-blue-600 dark:text-blue-400 font-semibold underline' : '' }}">
                        Kebijakan Privasi
                    </a>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © {{ date('Y') }} <a href="/" class="hover:underline">Polle™</a>. Hak Cipta Dilindungi Undang-Undang.
        </span>
    </div>
</footer>
