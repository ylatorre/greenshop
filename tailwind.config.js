/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      backgroundColor: {
        'custom-gray': 'orange-100', // Setting custom-gray background color to orange-100
      },
    },
  },
  plugins: [],
}
