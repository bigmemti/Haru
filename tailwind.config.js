import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const { themeVariants, prefersLight } = require("tailwindcss-theme-variants");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode : 'selector',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('daisyui'),
        forms,
        themeVariants({
            themes: {
                light: {
                    selector: ".light",
                },
                dark: {
                    selector: ".dark",
                },
            },
        }),
    ],
};
