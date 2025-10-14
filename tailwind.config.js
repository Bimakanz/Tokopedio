/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // penting! ini biar dark mode pakai class, bukan otomatis
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
