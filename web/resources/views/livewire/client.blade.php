<div>
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-950 text-white py-16 sm:py-24 md:py-32">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-up">
                Polling Cepat, Keputusan Tepat.
            </h1>
            <p class="text-lg sm:text-xl font-light opacity-80 max-w-2xl mx-auto mb-8 animate-fade-in-up delay-100">
                Buat dan bagikan vote online dengan mudah, atau ikuti vote dengan memasukkan token.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 animate-fade-in-up delay-200">
                <a href="/admin/polls" class="w-full sm:w-auto px-8 py-3 bg-white text-blue-600 font-bold rounded-full shadow-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                    Buat Vote
                </a>
                <a href="{{ route('voter.login') }}" class="w-full sm:w-auto px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-600 transition duration-300 transform hover:scale-105">
                    Ikuti Vote
                </a>
            </div>
        </div>
    </header>
    
    <main id="fitur" class="max-w-6xl mx-auto p-4 sm:p-8 md:p-12">
        <section class="text-center my-12 md:my-20">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">Fitur Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M17 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Buat Vote Mudah</h3>
                    <p class="text-gray-600 dark:text-gray-400">Buat vote dengan pertanyaan dan opsi pilihan dalam hitungan detik. Tidak perlu daftar atau login.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7l-6 6-6-6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11l-6 6-6-6"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Bagikan dengan Token Unik</h3>
                    <p class="text-gray-600 dark:text-gray-400">Setiap vote memiliki token unik yang dapat Anda bagikan untuk mengumpulkan respons.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                    <div class="text-blue-600 dark:text-blue-400 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Lihat Hasil Real-time</h3>
                    <p class="text-gray-600 dark:text-gray-400">Pantau hasil vote secara langsung saat responden memberikan suara mereka.</p>
                </div>
            </div>
        </section>
    
        <section id="ikuti-vote" class="bg-blue-50 dark:bg-gray-800 p-6 sm:p-8 md:p-10 rounded-lg shadow-lg my-12">
            <div class="text-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-4">Sudah Punya Token Vote?</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto mb-6">
                    Masukkan token unik yang diberikan oleh pembuat vote untuk berpartisipasi.
                </p>
                <a href="{{ route('voter.login') }}" class="w-full sm:w-auto px-8 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
                    Ikuti Vote
                </a>
            </div>
        </section>
    
        <section class="text-center my-12 md:my-20">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Mulai Buat Vote Pertama Anda!
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
                Cepat, mudah, dan gratis. Tidak perlu pusing lagi dengan keputusan grup.
            </p>
            <a href="/admin/polls" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition duration-300 transform hover:scale-105">
                Buat Vote Sekarang
            </a>
        </section>
    </main>
</div>



