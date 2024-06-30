/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        "dark-purple": "#081A51",
        "light-white": 'rgba(255,255,255,0.18)'
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

