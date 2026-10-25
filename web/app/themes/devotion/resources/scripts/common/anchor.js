document.addEventListener('DOMContentLoaded', () => {
	// Construct a selector for both relative and absolute URLs that include a hash
	const base = window.location.origin; // e.g., http://localhost:3000
	const selector = `a[href^="#"], a[href^="${base}/#"]`;
	const anchors = document.querySelectorAll(selector);

	for (let anchor of anchors) {
		anchor.addEventListener('click', (e) => {
			// Prevent default action for the anchor
			e.preventDefault();

			// Extract the hash value, considering both relative and absolute URLs
			const href = anchor.getAttribute('href');
			const hashIndex = href.indexOf('#');
			const blockID = href.substring(hashIndex + 1);

			// Use the extracted hash to perform smooth scrolling
			smoothScrollTo(blockID);
		});
	}

	// Function to handle smooth scrolling
	function smoothScrollTo(blockID) {
		const element = document.getElementById(blockID);
		if (element) {
			const offset = 100; // Offset in pixels
			const elementPosition =
				element.getBoundingClientRect().top + window.pageYOffset;
			const offsetPosition = elementPosition - offset;

			window.scrollTo({
				top: offsetPosition,
				behavior: 'smooth',
			});
		}
	}

	// Attempt to scroll to the hash in the URL on load
	if (window.location.hash) {
		setTimeout(() => {
			smoothScrollTo(window.location.hash.substring(1));
		}, 0); // Adjust the timeout as necessary
	}
});
