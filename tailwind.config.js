const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    extend: {
        backgroundImage: {
            'home': "url('../public/zj_portada_site.jpg')",
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
