/* global lechateaudesormeaux */
import modular from '@19h47/modular';
import { body, html } from 'utils/environment';

const { text_domain: textDomain } = lechateaudesormeaux;

// eslint-disable-next-line new-cap
const app = new modular({ modules: [] });

function init() {
	app.init(app);

	html.classList.add('is-loaded');
	html.classList.add('is-ready');
	html.classList.add('is-first-load');
	html.classList.remove('is-loading');
	body.classList.remove('cursor-wait');

	setTimeout(() => {
		html.classList.add('has-dom-ready');
	}, 0);
}

window.onload = async () => {
	const $style = document.getElementById(`${textDomain}-main-css`);

	if ($style) {
		if ($style.isLoaded) {
			init();
		} else {
			$style.addEventListener('load', () => init());
		}
	} else {
		console.warn(`The "${textDomain}-main-css" stylesheet not found`);
	}
};
