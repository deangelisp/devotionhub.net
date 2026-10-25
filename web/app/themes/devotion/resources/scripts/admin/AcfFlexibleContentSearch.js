const AcfFlexibleContentSearch = () => {
	if (window.acf) {
		const FeatureFlexibleContentExtension = window.acf.Model.extend({
			wait: 'ready',

			events: {
				'click [data-name="add-layout"]': 'onClick',
			},

			initialize: function () {
				// prevent closing popup when clicking on the search field
				document.body.addEventListener(
					'click',
					(event) => {
						if (
							event.target.classList.contains(
								'flyntComponentSearch-field',
							)
						) {
							event.stopPropagation();
						}
					},
					false,
				);
			},

			onClick: function (e, $el) {
				const $tooltips = document.querySelectorAll('.acf-fc-popup');

				$tooltips.forEach(($tooltip) => {
					const position = $tooltip.classList.contains('top')
						? 'top'
						: 'bottom';
					this.render($tooltip, position);

					if ($tooltip.classList.contains('top')) {
						const $target = $el[0];
						const targetTop =
							$target.getBoundingClientRect().bottom;
						const targetHeight =
							$target.getBoundingClientRect().height;
						const offsetBottom =
							window.innerHeight -
							window.scrollY -
							targetTop +
							targetHeight +
							10;
						$tooltip.style.top = 'auto';
						$tooltip.style.bottom = `${offsetBottom}px`;
					}
				});
			},

			render: function ($tooltip, position) {
				if ($tooltip.querySelector('.acf-fc-layouts-search')) {
					return;
				}

				$tooltip.insertAdjacentHTML(
					position === 'top' ? 'beforeend' : 'afterbegin',
					`<div class="acf-fc-layouts-search">
                <input type="text" placeholder="Search..." class="acf-fc-layouts-search-field">
                <div class="acf-fc-layouts-search-noresults" hidden>No blocks found</div>
              </div>`,
				);

				const $searchField = $tooltip.querySelector(
					'.acf-fc-layouts-search-field',
				);
				const $noResults = $tooltip.querySelector(
					'.acf-fc-layouts-search-noresults',
				);
				const $listItems = $tooltip.querySelectorAll('ul li');

				$searchField.focus();

				$searchField.addEventListener('input', (e) => {
					const searchedTerms = e.target.value
						.toLowerCase()
						.split(' ')
						.filter((i) => i);
					const hasResults = this.filterComponents(
						searchedTerms,
						$listItems,
					);
					$noResults.toggleAttribute('hidden', hasResults);
				});
			},

			filterComponents: function (searchedTerms, $listItems) {
				const hasResults = [];

				$listItems.forEach(($item) => {
					const componentName = $item.innerText.toLowerCase();
					const hasResult = searchedTerms.every(
						(term) => componentName.indexOf(term) > -1,
					);
					$item.style.display = hasResult ? 'block' : 'none';
					if (hasResult) {
						hasResults.push(hasResult);
					}
				});

				return hasResults.length > 0;
			},
		});

		// eslint-disable-next-line no-new
		new FeatureFlexibleContentExtension();
	}
};

export default AcfFlexibleContentSearch;
