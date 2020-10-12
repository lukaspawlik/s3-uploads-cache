<?php
/**
 * Plugin Name: S3 Uploads Cache
 * Description: Object cache support for S3 Uploads Plugin
 * Author: <a href="https://github.com/lukaspawlik">Lukasz Pawlik</a>, <a href="https://xwp.co">XWP</a>
 * Version: 1.0.0
 * Author URI: https://github.com/lukaspawlik
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require 'vendor/autoload.php';
}

add_action( 'plugins_loaded', 's3_uploads_cache_init', 9999, 0 );

/**
 * Check whether S3 uploads classes exist and initialize plugin.
 *
 * @return void
 */
function s3_uploads_cache_init() {

	/**
	 * Bail out if S3_Uploads class does not exist.
	 */
	if ( ! class_exists( 'S3_Uploads' ) || ! function_exists( 's3_uploads_init' ) || ! class_exists( 'Aws\S3\StreamWrapper' ) ) {
		return;
	}

	/**
	 * Below lines are copy/pasted from original S3 Uploads plugin as we need to check whether
	 * S3 Uploads can operate normally or not.
	 */
	if ( ! s3_uploads_check_requirements() ) {
		return;
	}

	if ( ! defined( 'S3_UPLOADS_BUCKET' ) ) {
		return;
	}

	if ( ( ! defined( 'S3_UPLOADS_KEY' ) || ! defined( 'S3_UPLOADS_SECRET' ) ) && ! defined( 'S3_UPLOADS_USE_INSTANCE_PROFILE' ) ) {
		return;
	}

	if ( ! s3_uploads_enabled() ) {
		return;
	}

	if ( ! defined( 'S3_UPLOADS_REGION' ) ) {
		return;
	}

	/**
	 * This plugin does not support S3 Uploads plugin stream wrapper so bail out.
	 */
	if ( defined( 'S3_UPLOADS_USE_LOCAL' ) && S3_UPLOADS_USE_LOCAL ) {
		return;
	}

	$s3_uploads_cache = new S3_Uploads_Cache();
	$s3_uploads_cache->init();
}
