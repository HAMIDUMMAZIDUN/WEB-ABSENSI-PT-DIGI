import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        // Daftar semua kemungkinan warna dept_colour yang akan Anda gunakan
        'bg-red-500',
        'bg-green-500',
        'bg-purple-500',
        'bg-indigo-500',
        'bg-gray-500',
        'bg-blue-500', // Tambahkan jika ada
        // Tambahkan semua warna bg-X-500 lainnya yang Anda gunakan untuk dept_colour
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
