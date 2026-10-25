const tabber = () => {
	const tabNavItems = document.querySelectorAll('.tabber-nav-item');

	const tabContentItems = document.querySelectorAll('.tabber-content-item');

	tabNavItems.forEach((tabNavItem, index) => {
		tabNavItem.addEventListener('click', function () {
			tabNavItems.forEach((item) => item.classList.remove('active'));

			tabNavItem.classList.add('active');

			tabContentItems.forEach((item) => item.classList.remove('active'));

			tabContentItems[index].classList.add('active');
		});
	});

	if (tabNavItems.length > 0 && tabContentItems.length > 0) {
		tabNavItems[0].classList.add('active');
		tabContentItems[0].classList.add('active');
	}
};

export default tabber;
