/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        primaryColor: 'blue', 
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
