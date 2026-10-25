const acfTabHashManager = () => {
	if (typeof acf !== 'undefined') {
		// run when ACF is ready
		acf.add_action('ready', function () {
			// check if there is a hash
			if (location.hash.length > 1) {
				// get everything after the #
				var hash = location.hash.substring(1);
				// loop through the tab buttons and try to find a match
				var buttons = document.querySelectorAll(
					'.acf-tab-wrap .acf-tab-button',
				);
				buttons.forEach(function (button) {
					if (
						hash ==
						button.innerText.toLowerCase().replaceAll(' ', '-')
					) {
						// if we found a match, click it then exit the loop
						button.click();
						return false;
					}
				});
			}
			// when a tab is clicked, update the hash in the URL
			var tabButtons = document.querySelectorAll(
				'.acf-tab-wrap .acf-tab-button',
			);
			tabButtons.forEach(function (button) {
				button.addEventListener('click', function () {
					location.hash =
						'#' + this.innerText.toLowerCase().replaceAll(' ', '-');
				});
			});
		});
	}
};

export default acfTabHashManager;
