const plugin = require('tailwindcss/plugin');
const { fontFamily, screens } = require('tailwindcss/defaultTheme');

const colors = {};

const fontSize = {};

const maxWidth = {};

const transitionDuration = {};

const spacing = {
	'0.5/12': `${(0.5 / 12) * 100}% `,
	'1/12': `${(1 / 12) * 100}% `,
	'1.5/12': `${(1.5 / 12) * 100}% `,
	'2/12': `${(2 / 12) * 100}% `,
	'2.5/12': `${(2.5 / 12) * 100}% `,
	'3/12': `${(3 / 12) * 100}% `,
	'3.5/12': `${(3.5 / 12) * 100}% `,
	'4/12': `${(4 / 12) * 100}% `,
	'4.5/12': `${(4.5 / 12) * 100}% `,
	'5/5.5': `${(5 / 5.5) * 100}% `,
	'5.5/12': `${(5.5 / 12) * 100}% `,
	'6/12': `${(6 / 12) * 100}% `,
	'6.5/12': `${(6.5 / 12) * 100}% `,
	'7/12': `${(7 / 12) * 100}% `,
	'8/12': `${(8 / 12) * 100}% `,
};

const zIndex = {
	1: '1',
	2: '2',
	3: '3',
	4: '4',
	5: '5',
};

const borderRadius = {};

module.exports = {
	content: ['./views/**/*.twig', './src/**/*.{html,js}', './includes/**/*.{php,json}'],
	corePlugins: {
		container: false,
	},
	theme: {
		screens: {
			prototype: '1920px',
			...screens,
		},
		extend: {
			animation: {
				float: 'float 7000ms ease-in-out infinite',
				marquee: 'marquee 8500ms linear infinite',
			},
			borderRadius,
			colors,
			fontSize,
			keyframes: {
				float: {
					'0%': { transform: 'translatey(0px)' },
					'50%': { transform: 'translatey(-1.25rem)' },
					'100%': { transform: 'translatey(0px)' },
				},
				marquee: {
					from: { transform: 'translateX(0)' },
					to: { transform: 'translateX(-100%)' },
				},
			},
			maxWidth,
			spacing,
			transitionDuration,
			zIndex,
		},
		fontFamily: {
			serif: ['"PT Serif"', ...fontFamily.serif],
		},
	},
	plugins: [
		plugin(({ addVariant }) => addVariant('nav-is-open', '.nav-is-open &')),
		plugin(({ addVariant }) => addVariant('is-safari', '.is-safari &')),
		plugin(({ addVariant }) => addVariant('is-active', '.is-active&')),
		plugin(({ addVariant }) => addVariant('is-ontop', '.is-ontop &')),
		plugin(({ addVariant }) => addVariant('parent-is-active', '.is-active > &')),
		plugin(({ addVariant }) => addVariant('grandparent-is-active', '.is-active > * > &')),
		plugin(({ addVariant }) => addVariant('parent-is-selected', '.is-selected > &')),
		plugin(({ addVariant }) => addVariant('parent-has-error', '.has-error > &')),
		plugin(({ addVariant }) => addVariant('is-disabled', '&[disabled],&:disabled')),
		plugin(({ addVariant }) => addVariant('swiper-slide-active', '.swiper-slide-active &')),
		plugin(({ addVariant }) => addVariant('first-child', '& > *:first-child')),
		plugin(({ addVariant }) => addVariant('last-child', '& > *:last-child')),
		plugin(({ addVariant }) => addVariant('is-scroll-up', '[data-direction="up"] &')),
		plugin(({ addVariant }) => addVariant('is-scroll-down', '[data-direction="down"] &')),
		plugin(({ addVariant }) => addVariant('is-inview', '.is-inview &')),
	],
};
