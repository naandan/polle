<button id="back-to-top"
    class="fixed bottom-6 right-6 p-4 rounded-full bg-blue-600 text-white shadow-lg
           transition-all duration-300 transform opacity-0 scale-0
           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
           dark:bg-blue-700 dark:hover:bg-blue-800"
    title="Kembali ke Atas">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<script>
    // Get the button
    const backToTopButton = document.getElementById('back-to-top');

    // When the user scrolls down 200px from the top of the document, show the button
    window.onscroll = function() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            backToTopButton.classList.remove('opacity-0', 'scale-0');
            backToTopButton.classList.add('opacity-100', 'scale-100');
        } else {
            backToTopButton.classList.remove('opacity-100', 'scale-100');
            backToTopButton.classList.add('opacity-0', 'scale-0');
        }
    };

    // When the user clicks on the button, scroll to the top of the document
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>