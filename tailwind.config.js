const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        container: {
            center: true
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            gray: colors.gray,
            black: colors.black,
            white: colors.white,
            red: colors.rose,
            yellow: colors.amber,
            green: colors.teal,
            blue: colors.blue,
            indigo: colors.indigo,
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },

    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
