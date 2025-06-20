import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'chinese': ['chinese_takeawayregular', 'sans-serif'],
            },
            colors: {
                'darkred': '#8B0000',
                'floralwhite': '#FFFAF0'
            }
        },
    },

    plugins: [forms],
};
