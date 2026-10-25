const scrollingLogos = () => {
	const logoContainer = document.getElementById('logo-cloud-loop');
	if (!logoContainer) {
		return;
	}

	let logoScrollWidth = logoContainer.scrollWidth;
	function animate() {
		const first = document.querySelector(
			'#logo-cloud-loop .logo-cloud-item-image',
		);

		if (!isElementInViewport(first)) {
			logoContainer.appendChild(first);
			logoContainer.scrollLeft -= first.offsetWidth;
		}

		if (logoContainer.scrollLeft !== logoScrollWidth) {
			logoContainer.scrollLeft += 1;
		}

		logoScrollWidth = logoContainer.scrollWidth;
		requestAnimationFrame(animate);
	}

	function isElementInViewport(el) {
		var rect = el.getBoundingClientRect();
		return rect.right > 0;
	}

	window.addEventListener('load', () => {
		requestAnimationFrame(animate);
	});
};

export default scrollingLogos;
