import domReady from '@roots/sage/client/dom-ready';
import acfTabHashManager from './admin/acfTabHashManager.js';
import disableAcfField from './admin/DisableAcfField.js';
import acfCopyButton from './admin/acfCopyButton.js';
import AcfAnchorBlock from './admin/AcfAnchorBlock.js';
import AcfFlexibleContentSearch from './admin/AcfFlexibleContentSearch.js';

/**
 * Application entrypoint
 */
domReady(async () => {
	acfTabHashManager();
	disableAcfField();
	acfCopyButton();
	AcfAnchorBlock();
	AcfFlexibleContentSearch();
});
