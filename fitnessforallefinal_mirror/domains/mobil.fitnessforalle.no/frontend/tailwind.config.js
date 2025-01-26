/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html", // Inkluder HTML-filen
    "./src/**/*.{js,ts,jsx,tsx}", // Søk etter CSS-klasser i alle filer i src-mappen
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
