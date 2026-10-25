import Swiper from 'swiper/bundle';
import {Navigation, Pagination, Autoplay} from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
	// grab all teh slides with .swiper-container and loop them
	document.querySelectorAll('.swiper-container').forEach((element) => {
		let args = {
			modules: [Navigation, Pagination, Autoplay],
			direction: 'horizontal',
			loop: true,
		};

		const navigation = element.dataset.navigation;
		const pagination = element.dataset.pagination;
		const autoplay = element.dataset.autoplay;
		const slidesPerView = element.dataset.slidesperview;
		const effect = element.dataset.effect;

		if (navigation) {
			args.navigation = {
				nextEl: '.swiper-btn-next',
				prevEl: '.swiper-btn-prev',
			};
		}

		if (pagination) {
			args.pagination = {
				el: '.swiper-pagination',
				clickable: true,
			};
		}

		if (autoplay) {
			const delay = element.dataset.delay;
			const disableOnInteraction = element.dataset.disableOnInteraction;

			args.autoplay = {
				delay: delay,
				disableOnInteraction: disableOnInteraction,
			};
		}

		if (slidesPerView > 1) {
			const spaceBetween = element.dataset.spacebetween;

			args.slidesPerView = slidesPerView;
			args.spaceBetween = spaceBetween;
			args.loop = false;
		}

		if (slidesPerView == 1 && effect) {
			args.effect = effect;

			if (effect == 'creative') {
				args.creativeEffect = {
					prev: {
						// will set `translateZ(-400px)` on previous slides
						translate: [0, 0, -400],
					},
					next: {
						// will set `translateX(100%)` on next slides
						translate: ['100%', 0, 0],
					},
				};
			}
		}

		new Swiper(element, args);
	});
});
