export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: { sans: ['DM Sans', 'sans-serif'] },
            colors: {
                brand: { DEFAULT: '#111111', light: '#f5f5f5', accent: '#E5E5E5' },
                cta: '#111111',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),
    ],
};