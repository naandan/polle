/** @type {import('tailwindcss').Config} */
module.exports = {
    theme: {
      extend: {
        fontFamily: {
          // ganti font sans default ke Poppins
          sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
        },
      },
    },
    plugins: [
      require('flowbite/plugin'),
    ],
  }
  