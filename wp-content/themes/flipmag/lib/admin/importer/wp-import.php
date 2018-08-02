<?php

/**
 * Extend the native importer to make the process better
 */

class Flipmag_Admin_Importer_WpImport extends WP_Import {

	public $the_images = array();

	public function __construct() 
	{
		@set_time_limit(0);

        //@ini_set('memory_limit', '512M');

		// pre-load featured images path
		$this->the_images = glob(get_template_directory() . '/admin/demo-data/images/*.jpg');

		//add_action('wp_insert_post', array($this, 'send_flush'));
	}

	/**
	 * Add an action at the process_term
	 * 
	 * @see WP_Import::process_terms()
	 */
	public function process_terms()
	{
		parent::process_terms();

		do_action('flipmag_import_process_terms', $this);
	}

	/**
	 * Use local random images for attachments
	 * 
	 * @see WP_Import::process_attachment()
	 */
	public function process_attachment($post, $url)
	{
		
		// pick a random image 
		if (is_array($this->the_images) && count($this->the_images)) {
			$image = $this->the_images[ array_rand($this->the_images) ];
			$url = content_url(substr($image, strrpos($image, '/themes/')));
		}
		else {
			return;
		}

		return parent::process_attachment($post, $url);
	}

	public function send_flush()
	{
		echo "<!-- flush -->";
		flush();
	}

	/**
	 * Use local images instead of remote images
	 * 
	 * @see WP_Import::fetch_remote_file()
	 */
	public function fetch_remote_file( $url, $post ) {
		// only use if demo-data is present in the url
		if (!strstr($url, '/demo-data/')) {
			return parent::fetch_remote_file($url, $post);
		}
		// extract the file name and extension from the url
		$file_name = basename( $url );

		// get placeholder file in the upload dir with a unique, sanitized filename
		$upload = wp_upload_bits( $file_name, 0, '', $post['upload_date'] );
		if ( $upload['error'] )
			return new WP_Error( 'upload_dir_error', $upload['error'] );

		// fetch the remote url and write it to the placeholder file
		$wp_http = new WP_Http();
		$response = $wp_http->request( $url, [ 'stream' => true, 'filename' => $upload['file'] ] );
		$headers = $response['headers'];

		// request failed
		if ( ! $response ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __('Remote server did not respond', 'flipmag') );
		}

		// make sure the fetch was successful
		if ( $response['response']['code'] != '200' ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', sprintf( __('Remote server returned error response %1$d %2$s', 'flipmag'), esc_html($headers['response']), get_status_header_desc($headers['response']) ) );
		}

		$filesize = filesize( $upload['file'] );

		if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __('Remote file is incorrect size', 'flipmag') );
		}

		if ( 0 == $filesize ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __('Zero size file downloaded', 'flipmag') );
		}

		$max_size = (int) $this->max_attachment_size();
		if ( ! empty( $max_size ) && $filesize > $max_size ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', sprintf(__('Remote file is too large, limit is %s', 'flipmag'), size_format($max_size) ) );
		}

		// keep track of the old and new urls so we can substitute them later
		$this->url_remap[$url] = $upload['url'];
		$this->url_remap[$post['guid']] = $upload['url']; // r13735, really needed?
		// keep track of the destination if the remote url is redirected somewhere else
		if ( isset($headers['x-final-location']) && $headers['x-final-location'] != $url )
			$this->url_remap[$headers['x-final-location']] = $upload['url'];

		return $upload;
	}
}