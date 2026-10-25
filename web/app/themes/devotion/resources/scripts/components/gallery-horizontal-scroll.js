const galleryHorizontalScroll = () => {
	const allGalleries = document.querySelectorAll(
		'.gallery-horizontal-scroll',
	);

	var visibleGalleries = [];

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					if (!visibleGalleries.includes(entry.target)) {
						visibleGalleries.push(entry.target);
					}
				} else {
					// If the gallery is no longer intersecting, remove it from the array
					const index = visibleGalleries.indexOf(entry.target);
					if (index > -1) {
						visibleGalleries.splice(index, 1);
					}
					observer.observe(entry.target);
				}
			});
		},
		{
			root: null,
			rootMargin: '0px 0px',
			threshold: 0,
		},
	);

	allGalleries.forEach((gallery) => {
		observer.observe(gallery);
	});

	const scrollGalleries = () => {
		visibleGalleries.forEach((gallery) => {
			const galleryRect = gallery.getBoundingClientRect();
			const galleryTop = galleryRect.top + window.scrollY;
			const scrolledPastGallery = Math.max(
				0,
				window.scrollY + window.innerHeight - galleryTop,
			);

			const maxScroll = galleryRect.height + window.innerHeight;

			const scrollPercentage = (scrolledPastGallery * 100) / maxScroll;

			const maxScrollLeft = gallery.scrollWidth - gallery.clientWidth;

			let scrollLeft;
			if (gallery.dataset.scrollOrigin === 'right') {
				scrollLeft =
					maxScrollLeft - (scrollPercentage * maxScrollLeft) / 100;
			} else {
				scrollLeft = (scrollPercentage * maxScrollLeft) / 100;
			}

			gallery.scrollLeft = scrollLeft;
		});
	};

	window.addEventListener('scroll', scrollGalleries);
};

export default galleryHorizontalScroll;
