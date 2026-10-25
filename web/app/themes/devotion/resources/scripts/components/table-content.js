const generateUUID = () => {
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(
		/[xy]/g,
		function (c) {
			var r = (Math.random() * 16) | 0,
				v = c == 'x' ? r : (r & 0x3) | 0x8;
			return v.toString(16);
		},
	);
};

const createSidebar = (entries) => {
	let sidebar = document.getElementById('entry-post-table-content');
	let items = [];

	entries.forEach((entry) => {
		let item = document.createElement('a');
		let className =
			'block mb-2 cursor-pointer opacity-75 hover:opacity-100 table-content-item';
		if (entry.tagName == 'H3') {
			className = `${className} pl-6`;
		}
		item.textContent = entry.title;
		item.className = className;
		item.href = `#${entry.id}`;

		item.addEventListener('click', (e) => {
			e.preventDefault();

			let targetElement = document.getElementById(entry.id);

			if (targetElement) {
				let topOffset =
					targetElement.getBoundingClientRect().top +
					window.scrollY -
					90;
				window.scrollTo({top: topOffset, behavior: 'smooth'});
			}

			adjustActiveTitle();
		});

		sidebar.appendChild(item);
		items.push(item);
		document.getElementById('sidebar-post').classList.remove('hidden');
	});

	const adjustActiveTitle = () => {
		let closestTitle = null;
		let closestOffset = Infinity;

		entries.forEach((entry) => {
			let element = document.getElementById(entry.id);
			let topOffset = element.getBoundingClientRect().top;

			// Here we find the title that is the closest to the top of the viewport (after header offset)
			if (topOffset > 0 && topOffset < closestOffset) {
				closestOffset = topOffset;
				closestTitle = element;
			}
		});

		// Reset all items to opacity-75
		items.forEach((item) => {
			item.classList.add('opacity-75');
			item.classList.remove('opacity-100', 'text-primary');
		});

		// Set the closest title's corresponding item to opacity-100
		if (closestTitle) {
			let anchorItem = sidebar.querySelector(
				`a[href="#${closestTitle.id}"]`,
			);
			anchorItem.classList.add('opacity-100', 'text-primary');
			anchorItem.classList.remove('opacity-75');
		}
	};

	adjustActiveTitle();

	// We'll call adjustActiveTitle on scroll events
	window.addEventListener('scroll', adjustActiveTitle);
};

const tableContent = () => {
	let tableContentIDs = [];

	let contentDiv = document.getElementById('entry-post-content');

	if (contentDiv) {
		let headings = contentDiv.querySelectorAll('h2, h3');

		headings.forEach((heading) => {
			let id = generateUUID();
			heading.id = id;

			tableContentIDs.push({
				id: id,
				title: heading.textContent,
				tagName: heading.tagName,
			});
		});

		createSidebar(tableContentIDs);
	}
};

export default tableContent;
