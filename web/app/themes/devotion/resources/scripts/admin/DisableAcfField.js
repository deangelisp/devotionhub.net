const disableAcfField = () => {
	const acfField = document.querySelector(
		'.acf-field-disabled input[type="text"]',
	);
	if (acfField) {
		acfField.style.pointerEvents = 'none';
	}
};

export default disableAcfField;
