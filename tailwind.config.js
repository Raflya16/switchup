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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand': {
                    'light': '#38bdf8', 
                    'DEFAULT': '#0ea5e9', 
                    'dark': '#0284c7',  
                },
                'primary': {
                    'light': '#60a5fa', 
                    'DEFAULT': '#3b82f6', 
                    'dark': '#2563eb',  
                },
            },
            borderColor: theme => ({
            ...theme('colors'),
            DEFAULT: theme('colors.gray.200', 'currentColor'),
            'primary': '#3b82f6', // blue-500
            }),
            ringColor: theme => ({
                ...theme('colors'),
                DEFAULT: theme('colors.blue.500', '#3b82f6'),
                'primary': '#3b82f6',
            }),
        },
    },

    plugins: [forms],
};