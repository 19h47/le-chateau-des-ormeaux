import { module as M } from '@19h47/modular';

class ModalButton extends M {
	constructor(m) {
		super(m);

		this.events = {
			click: 'show',
		};
	}

	show() {
		console.log('ModalButton.show');
		this.call('show', null, 'Modal');
	}
}

export default ModalButton;
