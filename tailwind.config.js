module.exports = {
  purge: [
    'source/**/*.blade.php',
    'source/**/*.md',
    'source/**/*.html',
  ],
  theme: {
    extend: {
      fontSize: {
        '9xl': '10rem'
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
