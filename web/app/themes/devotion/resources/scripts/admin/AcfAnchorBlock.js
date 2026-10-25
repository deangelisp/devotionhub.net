const AcfAnchorBlock = () => {
	const container = document.querySelector('#poststuff'); // Common parent of dynamically added fields

	// Check if the container exists
	if (!container) return;

	const processInputValue = (input, output) => {
		let value = input.value;
		value = value
			.toLowerCase()
			.replace(/ /g, '-')
			.replace(/[^\w-]+/g, '');
		output.innerText = value;
	};

	// Use event delegation to handle input event on dynamically added fields
	container.addEventListener('input', (e) => {
		if (e.target.closest('.acf-field[data-name="anchor"]')) {
			const block = e.target.closest('.layout[data-layout="anchor"]');
			if (!block) return;

			const output = block.querySelector('.anchor-link-url-output');
			if (!output) return;

			processInputValue(e.target, output);
		}
	});

	// when click on the button .anchor-link-button copy the value of the input to the clipboard
	container.addEventListener('click', (e) => {
		const button = e.target.closest('.anchor-link-button');

		if (button) {
			// Find the closest parent block that matches the specific layout
			const block = button.closest('.layout[data-layout="anchor"]');
			if (!block) return;

			const output = block.querySelector('.anchor-link-url');

			if (!output) return;

			// Use the Clipboard API to copy the text
			const value = `${output.innerText}`;

			const feedback = block.querySelector(
				'.anchor-link-instructions-feedback',
			);

			navigator.clipboard
				.writeText(value)
				.then(() => {
					feedback.classList.add('show');
					setTimeout(() => {
						feedback.classList.remove('show');
					}, 3000);
				})
				.catch((err) => {
					console.error('Failed to copy text: ', err);
				});
		}
	});

	// Initial processing of inputs on page load
	document
		.querySelectorAll('.layout[data-layout="anchor"]')
		.forEach((block) => {
			const input = block.querySelector(
				'.acf-field[data-name="anchor"] input[type="text"]',
			);
			const output = block.querySelector('.anchor-link-url-output');
			if (input && output) {
				processInputValue(input, output);
			}
		});
};

export default AcfAnchorBlock;
