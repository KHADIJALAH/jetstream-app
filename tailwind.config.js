// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  safelist: [
    {
      pattern: /bg-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /text-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /ring-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /border-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /focus:ring-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /focus:border-violet-(100|200|300|400|500|600|700|800|900)/,
    },
    {
      pattern: /hover:bg-violet-(100|200|300|400|500|600|700|800|900)/,
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
