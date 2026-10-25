<?php
/**
 * Configuration overrides for WP_ENV === 'production'
 */

use function Env\env;
use Roots\WPConfig\Config;

Config::define('WP_AUTO_UPDATE_CORE', true);
