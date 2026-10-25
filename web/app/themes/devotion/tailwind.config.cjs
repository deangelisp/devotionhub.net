/** @type {import('tailwindcss').Config} config */
const config = {
	content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
	safelist: [
		{
			pattern: /grid|grid-cols|gap|items|col-span|aspect/,
			variants: ['sm', 'md', 'lg'],
		},
		{
			// add font size to safelist
			pattern:
				/text-xs|text-sm|text-base|text-lg|text-xl|text-2xl|text-3xl|text-4xl|text-5xl|text-6xl/,
		},
	],
	theme: {
		extend: {
			aspectRatio: {
				portrait: '3/4',
				reel: '9/16',
			},
		},
		container: {
			center: true,
		},
	},
};

// export default config;

module.exports = config;
