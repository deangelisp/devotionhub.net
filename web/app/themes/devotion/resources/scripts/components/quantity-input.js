const modifyQuantity = (btn, operation) => {
	btn.addEventListener('click', function (e) {
		e.preventDefault();

		const inputQty =
			e.currentTarget.parentElement.querySelector('input.qty');
		const val = parseInt(inputQty.value, 10);
		const step = parseInt(inputQty.getAttribute('step') || '1', 10);
		const max = parseInt(inputQty.getAttribute('max'), 10) || Infinity;
		const min = parseInt(inputQty.getAttribute('min') || 0, 10);

		let newValue = operation === 'increment' ? val + step : val - step;

		if (newValue <= max && newValue >= min) {
			inputQty.value = newValue;
			inputQty.dispatchEvent(new Event('change'));
		}
	});
};

const quantityInputs = () => {
	document
		.querySelectorAll('.woocommerce .quantity .minus')
		.forEach((btn) => modifyQuantity(btn, 'decrement'));

	document
		.querySelectorAll('.woocommerce .quantity .plus')
		.forEach((btn) => modifyQuantity(btn, 'increment'));

	document.querySelectorAll('input.qty').forEach((input) => {
		input.addEventListener('input', function (e) {
			e.target.value = e.target.value.replace(/[^0-9]/g, '');
		});

		input.addEventListener('blur', function (e) {
			const min = parseInt(e.target.getAttribute('min') || '1', 10);
			const max = parseInt(e.target.getAttribute('max') || Infinity, 10);
			let value = parseInt(e.target.value, 10);

			// If the input is empty or less than the min, set it to min
			if (isNaN(value) || value < min) {
				value = min;
			}

			// If the input is greater than the max, set it to max
			if (value > max) {
				value = max;
			}

			e.target.value = value;
		});
	});
};

export default quantityInputs;
