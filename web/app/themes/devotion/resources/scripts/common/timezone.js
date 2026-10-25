document.addEventListener('DOMContentLoaded', function () {
	const timeZone = document.getElementById('timezone');

	if (timeZone) {
		timeZone.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
	}
});
