/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: 'var(--primary-color)',
          light: 'color-mix(in srgb, var(--primary-color) 80%, white)',
          dark: 'color-mix(in srgb, var(--primary-color) 80%, black)',
        },
        secondary: {
          DEFAULT: 'var(--secondary-color)',
          light: 'color-mix(in srgb, var(--secondary-color) 80%, white)',
          dark: 'color-mix(in srgb, var(--secondary-color) 80%, black)',
        },
        accent: {
          DEFAULT: 'var(--accent-color)',
          light: 'color-mix(in srgb, var(--accent-color) 80%, white)',
          dark: 'color-mix(in srgb, var(--accent-color) 80%, black)',
        },
        background: {
          DEFAULT: 'var(--background-color)',
          alt: 'color-mix(in srgb, var(--background-color) 95%, black)',
        },
        text: {
          DEFAULT: 'var(--text-color)',
          light: 'color-mix(in srgb, var(--text-color) 80%, white)',
          dark: 'color-mix(in srgb, var(--text-color) 80%, black)',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}