const progressBar = () => {
	const content = document.getElementById('entry-post-content');
	const progressBarLine = document.getElementById('progress-bar-line');

	if (!content || !progressBarLine) return;

	const contentHeight = content.clientHeight - window.innerHeight / 6;
	const scrolled = window.scrollY - content.offsetTop + 200;
	let progress = (scrolled / contentHeight) * 100;

	// Ensure progress is between 0% and 100%
	progress = Math.min(Math.max(progress, 0), 100);

	progressBarLine.style.width = progress + '%';

	window.addEventListener('scroll', progressBar);
};

export default progressBar;
