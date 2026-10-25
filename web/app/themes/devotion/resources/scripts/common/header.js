// Acivate the responsive menu
var mainHeaderHeight = false;
var headerSpotlightBar = 0;
var mobileMenu = false;

// Set header Height
function updateTotalHeaderHeightVar() {
	var totalHeaderHeight = headerSpotlightBar + mainHeaderHeight?.offsetHeight;

	// Update the CSS variable in :root
	document.documentElement.style.setProperty(
		'--total-header-height',
		`${totalHeaderHeight}px`,
	);
}

function setMobileMenuHeight() {
	let headerTotalHeight = mainHeaderHeight?.offsetHeight + headerSpotlightBar;

	mobileMenu.style.height = `calc(100svh - ${headerTotalHeight}px)`;
}

function updateHeaderHeights() {
	if (mobileMenu && window.innerWidth < 1024) {
		setMobileMenuHeight();
	} else {
		updateTotalHeaderHeightVar();
	}
}

// Actions

window.addEventListener('DOMContentLoaded', () => {
	headerSpotlightBar = document.getElementById('header-spotlight-bar');
	mainHeaderHeight = document.getElementById('main-header');
	mobileMenu = document.getElementById('mobile-menu');

	if (headerSpotlightBar) {
		headerSpotlightBar = headerSpotlightBar?.offsetHeight;
	} else {
		headerSpotlightBar = 0;
	}

	updateHeaderHeights();

	// Mobile Menu
	const menu = document.getElementById('header-menu');
	const html = document.querySelector('html');
	const subMenuOpen = document.querySelectorAll('.mobile-menu-open-submenu');
	const subMenuClose = document.querySelectorAll(
		'.mobile-menu-close-submenu',
	);

	subMenuOpen?.forEach((button) => {
		button.addEventListener('click', () => {
			button.parentElement.classList.add('active');
		});
	});

	subMenuClose?.forEach((button) => {
		button.addEventListener('click', () => {
			button.parentElement.parentElement.classList.remove('active');
		});
	});

	menu?.addEventListener('click', () => {
		menu.classList.toggle('active');
		mainHeaderHeight.classList.toggle('active');
		html.classList.toggle('no-scroll');
		mobileMenu.classList.toggle('active');
	});
});
window.addEventListener('resize', updateHeaderHeights);
