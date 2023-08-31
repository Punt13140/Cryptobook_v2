/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');

module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        plugin(function ({addUtilities, addComponents, e, config}) {
            // Add your custom styles here
        }),
        'prettier-plugin-tailwindcss',
        require('@tailwindcss/forms'),
    ],
}

