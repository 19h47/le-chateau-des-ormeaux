import { module as M } from '@19h47/modular';

class Image extends M {
	constructor(m) {
		super(m);

		this.load = this.load.bind(this);
	}

	init() {
		// Complete checks if img is loaded from cache
		if (this.el.complete) {
			return this.active();
		}

		// else add event listener to check once img has loaded
		return this.el.addEventListener('load', this.load);
	}

	load() {
		this.active();

		this.el.removeEventListener('load', this.load);
	}

	active() {
		this.el.classList.add('is-active');
	}
}

export default Image;
