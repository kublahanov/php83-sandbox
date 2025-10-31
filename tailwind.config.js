/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./src/html/public/**/*.php",
        "./src/html/public/**/*.html"
    ],
    safelist: [],
    theme: {
        extend: {
            animation: {
                'gradient': 'gradient 8s linear infinite',
                'float': 'float 6s ease-in-out infinite',
            }
        },
    },
    plugins: [],
}
