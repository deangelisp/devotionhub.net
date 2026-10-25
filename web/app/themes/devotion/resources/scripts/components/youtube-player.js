const youtubePlayer = () => {
	console.log('first');
	const youtubePlayerList = document.querySelectorAll('.youtube-player-item');

	youtubePlayerList.forEach((youtubePlayerItem) => {
		youtubePlayerItem.addEventListener('click', () => {
			console.log('click');
			new YT.Player(youtubePlayerItem.id, {
				videoId: youtubePlayerItem.dataset.videoId,
				playerVars: {
					autoplay: 1,
					controls: 1, // You might want controls for Shorts
					showinfo: 0,
					modestbranding: 1,
					rel: 0,
					fs: 0,
					allowFullScreen: 1,
				},
				events: {
					onReady: onPlayerReady,
				},
			});
		});
	});
};
function onPlayerReady(event) {
	event.target.playVideo(); // Automatically play the video when ready
}

export default youtubePlayer;
