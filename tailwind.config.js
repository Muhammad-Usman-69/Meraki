/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "index.php",
    "test.html",
    "p.php",
    "side/*.js"
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

