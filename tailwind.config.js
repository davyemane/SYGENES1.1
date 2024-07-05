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
        primaryHover: {
          DEFAULT: 'var(--primary-color-hover)',
          light: 'color-mix(in srgb, var(--primary-color-hover) 80%, white)',
          dark: 'color-mix(in srgb, var(--primary-color-hover) 80%, black)',
        },
        secondary: {
          DEFAULT: 'var(--secondary-color)',
          light: 'color-mix(in srgb, var(--secondary-color) 80%, white)',
          dark: 'color-mix(in srgb, var(--secondary-color) 80%, black)',
        },
        secondaryHover: {
          DEFAULT: 'var(--secondary-color-hover)',
          light: 'color-mix(in srgb, var(--secondary-color-hover) 80%, white)',
          dark: 'color-mix(in srgb, var(--secondary-color-hover) 80%, black)',
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
        gray: {
          subtle: 'color-mix(in srgb, var(--text-color) 5%, var(--background-color))',
          light: 'color-mix(in srgb, var(--text-color) 20%, var(--background-color))',
          medium: 'color-mix(in srgb, var(--text-color) 40%, var(--background-color))',
          dark: 'color-mix(in srgb, var(--text-color) 60%, var(--background-color))',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}