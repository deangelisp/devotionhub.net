const imageScrollEffect = () => {
	const image1 = document.querySelector('.image1');
	const image2 = document.querySelector('.image2');
	const maxMovement = 100; // Maximum number of pixels the images can move
	const middleScreen = window.innerHeight / 2; // Middle of the screen
	let lastScrollTop = 0;

	// Function to move images
	function moveImages(scrollTop) {
		const scrollMiddle = scrollTop + middleScreen;
		const pivotPoint = document.documentElement.offsetHeight / 2; // Middle of the document

		// Determine the direction of movement based on scroll position
		let direction = scrollMiddle < pivotPoint ? -1 : 1;

		// Calculate offset based on distance from the middle of the document
		let offset = Math.min(
			Math.abs(scrollMiddle - pivotPoint) / pivotPoint,
			1,
		);
		let movement = maxMovement * offset * direction;

		// Apply the movement
		image1.style.transform = `translateY(${movement}px)`;
		image2.style.transform = `translateY(${-movement}px)`;
	}

	// Event listener for scrolling
	window.addEventListener('scroll', () => {
		console.log('first');
		const scrollTop =
			window.pageYOffset || document.documentElement.scrollTop;

		// Move images based on the scroll position
		moveImages(scrollTop);

		// If the middle of the screen is close to the middle of the document, reset positions
		if (
			Math.abs(
				scrollTop +
					middleScreen -
					document.documentElement.offsetHeight / 2,
			) < 50
		) {
			// Optional: Add a transition for the elastic effect
			image1.style.transition = 'transform 0.5s ease-out';
			image2.style.transition = 'transform 0.5s ease-out';

			// Reset the transform to bring images back to original position
			image1.style.transform = 'translateY(0px)';
			image2.style.transform = 'translateY(0px)';

			// After the transition, remove the style to prevent it from affecting future scrolls
			setTimeout(() => {
				image1.style.transition = '';
				image2.style.transition = '';
			}, 500); // This duration should match the transition duration
		}

		lastScrollTop = scrollTop;
	});
};

// export default imageScrollEffect;
