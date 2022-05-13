module.exports = {
  content: [

    "./templates/**/*.html.twig",
    "./assets/components/**/*.vue"


  ],
  theme: {
    extend: {},
  },
  plugins: [
     require('tailwindcss'),],
}
