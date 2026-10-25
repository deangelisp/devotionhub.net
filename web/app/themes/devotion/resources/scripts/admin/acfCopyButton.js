const acfCopyButton = () => {
	const copyButon = document.querySelector('.acf-copy-button');

	if (copyButon) {
		copyButon.addEventListener('click', (e) => {
			e.preventDefault();

			const value = document.querySelector('.acf-copy-from').innerText;

			navigator.clipboard
				.writeText(value)
				.then(() => {
					alert('Copied to clipboard');
				})
				.catch((err) => {
					console.error('Failed to copy text: ', err);
				});
		});
	}
};

export default acfCopyButton;
