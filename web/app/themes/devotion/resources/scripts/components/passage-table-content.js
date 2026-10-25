const passageTableContent = () => {
	const content = document.querySelector('.content-for-sidebar');

	if (!content) {
		return;
	}

	const h2Elements = content.querySelectorAll('h2');

	if (h2Elements.length === 0) {
		return;
	}

	const tableOfContents = document.getElementById('table-of-contents');

	tableOfContents.innerHTML =
		'<span class="block font-semibold text-gray-700">On this page</span>';

	// grab h1 title
	const h1 = document.querySelector('h1 .title');
	const h1Id = h1.textContent
		.toLowerCase()
		.replace(/[^a-z0-9-]/g, '')
		.replace(/\s/g, '');

	h1.setAttribute('id', h1Id);

	const h1Link = document.createElement('a');
	h1Link.setAttribute('href', `#${h1Id}`);
	h1Link.classList.add('table-of-contents--item');
	h1Link.classList.add('active');
	h1Link.textContent = h1.textContent;

	tableOfContents.appendChild(h1Link);

	h2Elements.forEach((element) => {
		const text = element.textContent;
		const id =
			text
				.toLowerCase()
				.replace(/[^a-z0-9-]/g, '')
				.replace(/\s/g, '') + Math.random().toString(36).substring(7);

		element.setAttribute('id', id);

		const link = document.createElement('a');
		link.setAttribute('href', `#${id}`);
		link.classList.add('table-of-contents--item');
		link.textContent = text;

		tableOfContents.appendChild(link);
	});

	const links = tableOfContents.querySelectorAll('a');

	links.forEach((link) => {
		link.addEventListener('click', (e) => {
			e.preventDefault();

			// remove active class from all links
			links.forEach((link) => link.classList.remove('active'));

			// add active class to clicked link
			link.classList.add('active');
		});
	});
};

export default passageTableContent;
