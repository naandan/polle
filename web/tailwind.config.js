/** @type {import('tailwindcss').Config} */
module.exports = {
    theme: {
      extend: {
        fontFamily: {
          sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
        },
      },
    },
    plugins: [
      require('flowbite/plugin'),
    ],
  }
  