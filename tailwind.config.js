/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ["Outfit", "sans-serif"],
        },
        colors: {
            "red": "#e63946ff",
            light: "#f1faeeff",
            "light-blue": "#a8dadcff",
            "blue-alt": "#457b9dff",
            "dark-blue": "#1d3557ff",

            // base:
            "light-alt": "#F9F9F9",
            white: "#fff",
            black: "#000",
            grey: "#e6e6e6",
            green: "#1CD97E",
        },
        extend: {},
    },
    plugins: [],
};
