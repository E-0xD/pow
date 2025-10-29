import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import ContainerQueries from "@tailwindcss/container-queries";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#7f13ec",
                "background-light": "#f7f6f8",
                "background-dark": "#191022",
                "text-light": "#141118",
                "text-dark": "#f7f6f8",
                "card-light": "#ffffff",
                "card-dark": "#21162d",
                "border-light": "#e0dbe6",
                "border-dark": "#3a2c4a",
                "subtle-light": "#756189",
                "subtle-dark": "#a89bb9",
                
            },
            fontFamily: {
                display: ["Manrope", "sans-serif"],
            },
            borderRadius: {
                DEFAULT: "0.5rem",
                lg: "1rem",
                xl: "1.5rem",
                full: "9999px",
            },
        },
    },
    plugins: [forms, typography, ContainerQueries],
    darkMode: 'class',
};
