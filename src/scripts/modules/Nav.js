import { module as M } from '@19h47/modular';

import { disableScroll, enableScroll } from 'utils/scroll';
import gsap from 'gsap';

class Nav extends M {
	constructor(m) {
		super(m);

		this.isOpen = this.el.classList.contains('is-open');

		this.events = {
			click: {
				backdrop: 'toggle',
				button: 'toggle',
			},
		};

		document.addEventListener('keydown', ({ key }) => {
			if ('Escape' === key) {
				this.close();
			}
		});
	}

	toggle() {
		if (this.isOpen) {
			return this.close();
		}

		return this.open();
	}

	open() {
		if (this.isOpen) {
			return false;
		}

		this.isOpen = true;

		this.$('background')[0].style.setProperty('transform', 'scaleX(1)');

		this.el.classList.add('is-active');
		gsap.to(this.el, { autoAlpha: 1 });

		// When Nav is open, disableScroll
		disableScroll();
		this.call('stop', false, 'Scroll', 'main');

		return true;
	}

	close() {
		if (!this.isOpen) {
			return false;
		}

		this.isOpen = false;

		this.$('background')[0].style.setProperty('transform', 'scaleX(0)');

		this.el.classList.remove('is-active');
		gsap.to(this.el, { autoAlpha: 0 });

		// When Nav is closed, enableScroll
		enableScroll();
		this.call('start', false, 'Scroll', 'main');

		return true;
	}
}

export default Nav;
