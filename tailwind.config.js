/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],  theme: {
    extend: {
      colors: {
        PrimaryGreen: '#A4AC86', // Replace this with your custom color code
        SecondaryGreen: '#004225',
        ThirdGreen: '#5DB075',
      },
      fontFamily: {
        OpanSans: ['"Opan Sans"', "open-sans"],
        lora: ['"lora"', "Lora"],

      backgroundColor: {
        'custom-gray': '#D6DDD1',

      },
    },
  },
  plugins: [],
}

