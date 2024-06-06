/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "index.php",
    "p.php",
    // "partials/*.php",
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

