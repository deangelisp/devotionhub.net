import domReady from '@roots/sage/client/dom-ready';
import accordion from './components/accordion.js';
import progressBar from './components/progress-bar.js';
import quantityInputs from './components/quantity-input.js';
import historyTimeline from './components/history-timeline.js';
import scrollingLogos from './components/scrolling-logos.js';
import galleryHorizontalScroll from './components/gallery-horizontal-scroll.js';
import tabber from './components/tabber.js';
import youtubePlayer from './components/youtube-player.js';
import createModals from './common/modal.js';
import passageTableContent from './components/passage-table-content.js';

import './common/header.js';
import './common/single-product.js';
import './common/anchor.js';
import './common/timezone.js';

/**
 * Application entrypoint
 */
domReady(async () => {
	accordion();
	quantityInputs();
	progressBar();
	historyTimeline();
	scrollingLogos();
	galleryHorizontalScroll();
	tabber();
	youtubePlayer();
	createModals();
	passageTableContent();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
