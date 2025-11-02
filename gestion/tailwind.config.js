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
                // --- TU PALETA DE COLORES PERSONALIZADA ---
                'brand': {
                    'background': '#C4F5FC', // Celeste claro
                    'primary':    '#247BA0', // Azul medio
                    'dark':       '#011627', // Azul oscuro (para botones)
                    'accent':     '#FFC482', // Naranja/acento
                    'secondary':  '#7D8491', // Gris
                },
            },
        },
    },

    plugins: [forms],
};