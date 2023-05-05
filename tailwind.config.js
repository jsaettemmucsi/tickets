const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
			colors: {
				'sagikos': 'rgb(255,101,122)',
			},
        },
    },
	variants: {
		extend: {
		  backgroundColor: ['even'],
		}
	  },

    plugins: [require('@tailwindcss/forms')],
};
