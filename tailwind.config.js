/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],  theme: {
    extend: {
      backgroundColor: {
        'custom-gray': '#D6DDD1',
      },
    },
  },
  plugins: [],
}

