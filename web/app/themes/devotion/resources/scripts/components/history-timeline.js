const historyTimeline = () => {
	const stickyElement = document.getElementById(
		'block-history-timeline-bar-progress',
	);

	if (!stickyElement) {
		return;
	}

	const container = document.getElementById('block-history-timeline-bar');

	const onScroll = () => {
		const containerRect = container.getBoundingClientRect();
		const stickyRect = stickyElement.getBoundingClientRect();

		if (containerRect.top < 0) {
			stickyElement.style.position = 'fixed';
			stickyElement.style.top = '0px';
			stickyElement.style.marginTop = '0px';
		} else {
			stickyElement.style.position = 'absolute';
			stickyElement.style.top = 'initial';
		}

		// Check if the half of the screen pass the end of the container
		if (containerRect.bottom < window.innerHeight / 2) {
			stickyElement.style.position = 'absolute';
			stickyElement.style.top = 'initial';
			stickyElement.style.bottom = '0px';
		} else {
			stickyElement.style.bottom = 'initial';
		}
	};

	window.addEventListener('scroll', onScroll);
	onScroll(); // Initialize position
};

export default historyTimeline;
