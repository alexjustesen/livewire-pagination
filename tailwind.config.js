const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    future: {
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
    },
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            }
        },
    },
    variants: {
        borderWidth: ['responsive', 'last', 'hover', 'focus'],
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/ui'),
    ],
}
