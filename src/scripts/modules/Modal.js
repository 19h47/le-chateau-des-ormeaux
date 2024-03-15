import { module as M } from '@19h47/modular';

class Modal extends M {
	constructor(m) {
		super(m);

		this.events = {
			click: {
				close: 'close',
			},
		};
	}

	close() {
		console.log('Modal.close');
		this.el.close();
	}

	show() {
		console.log('Modal.show');
		this.el.showModal();
	}
}

export default Modal;
