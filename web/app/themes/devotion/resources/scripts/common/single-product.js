import domReady from '@roots/sage/client/dom-ready';

domReady(() => {
	moveTrigger(1);

	// triggerPhotoswipe();
});

// Move the triger to the images block
function moveTrigger(attempt) {
	if (attempt > 10) {
		return;
	}

	const $trigger = document.getElementById(
		'woocommerce-product-gallery__trigger',
	);

	// ProductGallery.prototype.initPhotoswipe = function() {

	if ($trigger) {
		const $images = document.querySelector(
			'.woocommerce-product-gallery > .flex-viewport',
		);

		if ($images) {
			$trigger.classList.remove('hidden');
			$trigger.classList.add('block');
			$trigger.addEventListener('click', triggerPhotoswipe);
			$images.prepend($trigger);
		} else {
			setTimeout(() => {
				moveTrigger(attempt + 1);
			}, 100);
		}
	}
}

function triggerPhotoswipe(e) {
	e.preventDefault();

	const $trigger = document.querySelector(
		'.woocommerce-product-gallery__image a:first-of-type',
	);

	$trigger.click();
}
