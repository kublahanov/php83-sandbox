/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        // Для PHP проекта
        "./src/html/public/**/*.php",
        "./src/html/public/**/*.html",
        // Для статических HTML страниц (docs)
        "./docs/**/*.html"
    ],
    safelist: [
        // Общие классы для обеих сборок
        { pattern: /bg-(red|green|blue|purple|yellow|gray)-(50|100|500|600|700|800|900)/ },
        { pattern: /text-(red|green|blue|purple|yellow|gray)-(500|600|700|800|900)/ },
        { pattern: /border-(red|green|blue|purple|yellow|gray)-500/ },
        'hover:scale-105',
        'hover:shadow-xl',
        'group-hover:scale-110',
        'animate-gradient',
        'animate-float'
    ],
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
