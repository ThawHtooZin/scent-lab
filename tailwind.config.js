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
            },
            colors: {
                primary: {
                    DEFAULT: '#B8860B',
                    light: '#D9A441',
                    dark: '#8B5E00',
                },
                secondary: {
                    DEFAULT: '#556B2F',
                    light: '#7A8F5A',
                    dark: '#3A4A1F',
                },
                tertiary: {
                    DEFAULT: '#F4DADA',
                    light: '#F8E6E6',
                    dark: '#D9B3B3',
                },
                neutral: {
                    DEFAULT: '#FAF9F6',
                    light: '#FFFFFF',
                    dark: '#D6D5D2',
                },
            },
        },
    },

    plugins: [forms],
};
