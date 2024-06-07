/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "*.php",
    "side/*.js",
    "partials/*"
  ],
  theme: {
    extend: {
      animation: {
        'animate-spin': 'spin 5s ease-in-out infinite'
      }
    },
  },
  plugins: [],
}

