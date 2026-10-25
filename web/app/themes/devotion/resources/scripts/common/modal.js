const createModals = () => {
	const modals = document.querySelectorAll('.component-modal');
	const html = document.querySelector('html');

	if (!modals) {
		return;
	}

	modals.forEach((modal) => {
		const modalContent = modal.querySelector('.component-modal__content');
		const modalClose = modal.querySelector('.component-modal__close');

		modalContent.addEventListener('click', (e) => {
			e.stopPropagation();
		});

		modal.addEventListener('click', () => {
			modal.classList.remove('is-active');
			html.classList.remove('no-scroll');
		});

		modalClose.addEventListener('click', () => {
			modal.classList.remove('is-active');
			html.classList.remove('no-scroll');
		});
	});

	const triggers = document.querySelectorAll('.component-modal-trigger');

	triggers.forEach((trigger) => {
		const target = trigger.getAttribute('data-target');
		const modal = document.getElementById(target);

		trigger.addEventListener('click', (e) => {
			e.preventDefault();

			modal.classList.add('is-active');

			html.classList.add('no-scroll');
		});
	});
};

export default createModals;
