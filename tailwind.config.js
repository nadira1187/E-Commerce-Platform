/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          700: '#1D4ED8',
          800: '#1E40AF',
          300: '#93C5FD',
          900: '#1E3A8A'
        }
      }
    },
  },
  plugins: [],
};
