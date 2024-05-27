import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                primary : {
                    50:"#f1f5fd",
                    100: "#dfe9fa",
                    200: "#c6d9f7",
                    300: "#9fc1f1",
                    400: "#729fe8",
                    500: "#4978df",
                    600: "#3c62d4",
                    700: "#334fc2",
                    800: "#2f429e",
                    900: "#2b3b7d"
                },
                gray: {
                    50: "#F9FAFB",
                    100: "#F3F4F6",
                    200: "#E5E7EB",
                    300: "#D1D5DB",
                    400: "#9CA3AF",
                    500: "#6B7280",
                    600: "#4B5563",
                    700: "#374151",
                    800: "#1F2937",
                    900: "#111827"
                },
                info: {
                    50 : "#EFF6FF",
                    100: "#BFDBFE",
                    400: "#60A5FA",
                    600: "#2563EB",
                    800: "#1E40AF",
                },
                success: {
                    50: "#EEFCF3",
                    200: "#B5F5CC",
                    400: "#4BD87D",
                    600: "#239849",
                    800: "#1B5A31"
                },
                warning: {
                    50: "#FFFBEB",
                    200: "#FDE68A",
                    300: "#FCD34D",
                    400: "#FBBF24",
                    600: "#D97706",
                    800: "#92400E"
                },
                danger: {
                    50: "#FEF2F2",
                    200: "#FECACA",
                    400: "#F87171",
                    600: "#DC2626",
                    800: "#991B1B"
                }
                
            }
        },
    },

    plugins: [forms],
};
