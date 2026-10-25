// Import the necessary PhotoSwipe modules and styles
// (assuming PhotoSwipe has been installed via npm or Yarn)
import PhotoSwipeLightbox from 'photoswipe/lightbox';

// Initialize the PhotoSwipeLightbox with options
document.addEventListener('DOMContentLoaded', () => {
	const galleryArray = [];
	const galleryItems = document.querySelectorAll('.gallery-item');

	galleryItems.forEach((element, index) => {
		element.setAttribute('data-index', index);

		const link = element.querySelector('a');
		const img = element.querySelector('img');

		if (!link) {
			return;
		}

		const item = {
			src: link.getAttribute('href'),
			w: parseInt(link.getAttribute('data-width')),
			h: parseInt(link.getAttribute('data-height')),
			title: img.getAttribute('title') || '',
		};

		galleryArray.push(item);
	});

	galleryItems.forEach((element, index) => {
		element.addEventListener('click', (event) => {
			event.preventDefault();

			const options = {
				gallery: '.gallery', // Assuming the gallery items are within a container with class 'gallery'
				children: '.gallery-item',
				index: parseInt(element.getAttribute('data-index')),
				// bgOpacity: 0.85,
				showHideOpacity: true,
				pswpModule: () => import('photoswipe'),
			};

			const lightbox = new PhotoSwipeLightbox(options);
			lightbox.init();
		});
	});
});
