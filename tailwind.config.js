import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

//** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/**/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/js/**/*.vue",
    "./storage/framework/views/*.php",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          DEFAULT: '#3C8C2B', // contoh hijau agro; nanti kita bisa samain brand CAC
          dark: '#2d661f',
          light: '#dff4cc',
        },
      },
    },
  },
  plugins: [],
}
