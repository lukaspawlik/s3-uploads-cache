<?php

use Aws\S3\StreamWrapper;

/**
 * Class S3_Uploads_Cache.
 *
 * Re-registers caching layer for S3 stream wrapper provided by AWS in AWS\S3\StreamWrapper
 */
class S3_Uploads_Cache {

	/**
	 * Init plugin logic.
	 *
	 * @return void
	 */
	public function init() {
		$instance = S3_Uploads::get_instance();
		$cache    = new S3_Uploads_Cache_Layer();

		/**
		 * Below code comes directly from original S3 Uploads plugin as we need to re-register stream wrapper.
		 */
		StreamWrapper::register( $instance->s3(), 's3', $cache );
		$acl = defined( 'S3_UPLOADS_OBJECT_ACL' ) ? S3_UPLOADS_OBJECT_ACL : 'public-read';
		stream_context_set_option( stream_context_get_default(), 's3', 'ACL', $acl );
		stream_context_set_option( stream_context_get_default(), 's3', 'seekable', true );
	}
}
