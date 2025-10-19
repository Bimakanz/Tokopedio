/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  safelist: [
    'animate-fadeIn', // biar nggak dihapus walau Tailwind nggak nemu di build
  ],
  theme: {
    extend: {
      keyframes: {
        fadeIn: {
          '0%': { opacity: 0, transform: 'translateY(10px)' },
          '100%': { opacity: 1, transform: 'translateY(0)' },
        },
      },
      animation: {
        fadeIn: 'fadeIn 0.9s ease-out forwards',
      },
    },
  },
  plugins: [],
}
