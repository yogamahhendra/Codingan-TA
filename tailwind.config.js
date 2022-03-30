module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens: {
        'laptopl': '1440px',
        // => @media (min-width: 1024px) { ... }
      },
      spacing: {
        88: '22rem',
        97: '27rem',
      },
      colors: {
        "bali": {
          "50": "#F8EFE2",
          "100": "#F1E0C5",
          "200": "#E4C08B",
          "300": "#D6A152",
          "400": "#B67E2B",
          "500": "#7B561D",
          "600": "#634517",
          "700": "#4A3412",
          "800": "#32220C",
          "900": "#191106"
        }
      },
    },
  },
  plugins: [],
}
