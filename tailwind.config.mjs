/** @type {import('tailwindcss').Config} */
export default {
	content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}'],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Inter', 'sans-serif'],
				mono: ['Geist Mono', 'monospace'],
			},
			animation: {
				blob: 'blob 7s infinite',
			},
		},
	},
	plugins: [],
}
