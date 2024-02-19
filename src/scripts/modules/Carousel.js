import { module as M } from '@19h47/modular';
import Swiper from 'swiper';
import { Autoplay } from 'swiper/modules';

Swiper.use([Autoplay]);

/**
 *
 * @constructor
 * @param {object} container
 */
class Carousel extends M {
	init() {
		const parameters = JSON.parse(this.getData('parameters')) || {};

		this.swiper = new Swiper(this.el, {
			...{ slidesPerView: 'auto' },
			...parameters,
		});
	}
}

export default Carousel;
