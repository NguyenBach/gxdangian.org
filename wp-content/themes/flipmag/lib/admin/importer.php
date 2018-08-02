<?php

/**
 * Demo Importer!
 * 
 * Import themes demo content.
 */

class Flipmag_Admin_Importer
{
	public $demo_data_path;
	public $demo_data_url;
	
	public function __construct()
	{	
		add_action('admin_menu', array($this, 'init'));
	}
	
	/**
	 * Register the page
	 */
	public function init() 
	{
		if (!current_user_can('manage_options')) {
			return;
		}

		add_theme_page(
			__('Demo Importer', 'flipmag'),
			__("Sample Import", 'flipmag'),
			'manage_options',
			'flipmag_demo_import',
			array($this, 'start_importer')
		);

	}

	/**
	 * Being the import process
	 */
	public function start_importer()
	{
		if (!isset($_POST['import_demo'])) {
		?>

		<div class="import-message" >
		<?php if(version_compare(phpversion(), '5.3.2', '<')){ 
			echo sprintf( __('%s Your php version %s not supported one click import need to upgrade php version above 5.3.2. you can import manually from wordpress menu Tools > import. %s', 'flipmag'), '<strong>', phpversion(), '</strong>' );
		}else{ ?>
			<?php echo sprintf( __('%s Sample Import %s For import sample content go to %s Appearance &gt; Flipmag Options &gt; Sample import. %s Import sample content from FlipMag official demo site. It needs a powerful webhost and may fail on a weaker one. It may take %s 2-4 %s minutes to complete. %s WARNING: Only use on an empty site and make sure you have enabled recommended plugins first! Existing widgets will NOT be deleted but it is a good idea to remove them. %s', 'flipmag'), '<h1>', '</h1><hr><p>','<strong>','</strong></p><p>','<strong>','</strong>' ,'<br><strong>', '</strong>' ); ?>
			<?php } ?>
		</div>

		<?php
		}

		// need to enable importers
		if (!defined('WP_LOAD_IMPORTERS')) {
			define('WP_LOAD_IMPORTERS', true);
		}

		if (!isset($_POST['import_demo'])) {
			return;
		}

		$this->set_image_defaults();

		// set demo data path according to demo type
		$this->demo_data_path = trailingslashit(get_template_directory() . '/admin/demo-data/' . sanitize_file_name($_POST['import_demo_type']));
		$this->demo_data_url = trailingslashit(get_template_directory_uri() . '/admin/demo-data/' . sanitize_file_name($_POST['import_demo_type']));

		// modify page meta to correct category mappings for page builder
		add_action('import_post_meta', array($this, 'remap_page_meta'), 10, 3);

		$xml_result = '';
		if ($_POST['import_type'] == 'full') {

			// start importing
			$xml_result = $this->import_xml();
	
			$this->import_widgets();
	
			// fix and reconfigure
			$this->configure_menu();
			$this->configure_home();
		}

		$this->import_theme_settings();

		?>

		<div class="import-message">

		<?php if ($_POST['import_type'] != 'full' OR stristr($xml_result, 'All Done')): ?>
			<h3 class="success"><?php _e('Import Completed!', 'flipmag'); ?></h3>
			<p><?php echo apply_filters('flipmag_import_successful', __('Your import has been completed successfully. Have fun! Refresh this page to see changed settings.', 'flipmag')); ?></p>

			<?php if (empty($_POST['import_image_gen']) && $_POST['import_type'] == 'full'): ?>
				<p><?php echo sprintf( __('%s REMINDER: %s Next Step: %s For correct thumbnails, install the plugin "Regenerate Thumbnails" and run it from Tools > Regen. Thumbnails.', 'flipmag') , '<h4>', '</h4> <strong>', '</strong>' ); ?></p>
			<?php endif; ?>

		<?php else: ?>

			<h3 class="failed"><?php _e('Import Failed!', 'flipmag'); ?></h3>
			<p><?php echo apply_filters('flipmag_import_failed', 
				__('Sorry but your import failed. Most likely, it cannot work with your webhost. You will have to ask your webhost to increase your PHP max_execution_time (or any other webserver timeout to at least 300 secs) and memory_limit (to at least 196M) temporarily.', 'flipmag')); ?></p>

		<?php endif; ?>

		</div>

		<?php

		// all done
		do_action('flipmag_import_completed', $this);
	}
	
	/**
	 * Import the main WXR file containing most of the import data
	 */
	public function import_xml()
	{		

		// get the importer plugin
		if (!class_exists('WP_Import')) {
			include_once get_template_directory() . '/lib/vendor/importer/wordpress-importer.php';
		}
		
		// disable all image sizes generation?
		if (empty($_POST['import_image_gen'])) {
			add_filter('intermediate_image_sizes_advanced', array($this, 'disable_image_sizes'));
		}

		$xml_file = $this->demo_data_path . 'sample.xml';

		if (file_exists($xml_file)) {

			ob_start();

			$this->wp_import = Flipmag::factory('admin/importer/wp-import');
			$this->wp_import->fetch_attachments = (!empty($_POST['import_media']) ? true : false);
			$this->wp_import->import($xml_file);

			$xml_result = ob_get_clean();
			
			return $xml_result;
		}

		return false;
	}

	/**
	 * Import widgets and fix invalid data
	 */
	public function import_widgets()
	{

		// get the widgets importer
		if (!function_exists('wie_import_data')) {
			include_once get_template_directory() . '/lib/vendor/importer/widgets-importer.php';
		}

		// get the widget data and import it
		$widget_data = $this->demo_data_path . 'widgets.wie';

		if (file_exists($widget_data)) {			
			
			ob_start();
			include $widget_data;
			$data = ob_get_clean();
			$data = json_decode( $data );
			

			/*
			 * Modify the sidebar data to assign new category mappings
			 */

			foreach ($data as $sidebar => $sidebar_data) {

				// only process if there are widgets
				if (!is_array($sidebar_data) && !is_object($sidebar_data)) {
					continue;
				}

				foreach ($sidebar_data as $widget => $widget_data) 
				{
					// only process if there are widgets
					if (!is_array($sidebar_data) && !is_object($sidebar_data)) {
						continue;
					}

					// process the widget data
					foreach ($widget_data as $key => $value) 
					{
						$processed = array();
						// only remapping the categories
						if (in_array($key, array('cats', 'category', 'cat', 'categories')) && (is_array($value) OR is_object($value))) {

							foreach ($value as $k => $v) {

								$processed[$k] = $v;

								// perhaps the value is a category id
								if (!empty($v) && is_numeric($v) && !empty($this->wp_import->processed_terms[$v])) {
									@$processed[$v] = $this->wp_import->processed_terms[$v];
								}

							}

							// update main data
							$data->$sidebar->$widget->$key = $processed;
						}
						else if (is_object($value)) {
							$data->$sidebar->$widget->$key = (array) $value;
						}

						// custom menu item? remap to the correct taxonomy
						if ($key == 'nav_menu' && !empty($this->wp_import->processed_terms[$value])) {
							$data->$sidebar->$widget->$key = $this->wp_import->processed_terms[$value];
						}


					} // end process widget data

				} // end process sidebars
			
			} // end main data modification loop

			ob_start();
			wie_import_data($data);
			$widget_result = ob_get_clean();
		} 

		return $widget_result;
	}

	/**
	 * Action Callback: Re-map data for Page Builder
	 * 
	 * @param integer $post_id
	 * @param string $meta_key
	 * @param array $data
	 */
	public function remap_page_meta($post_id, $meta_key = '', $data = '') 
	{

		if (empty($meta_key) OR empty($data)) {
			return;
		}

		if ($meta_key == 'panels_data') {

			if (empty($data['widgets'])) {
				return;
			}

			// preserve for comparison - save resources - go green!
			$orig_data = $data;

			// fix category mapping in widgets
			foreach ($data['widgets'] as $widget => $widget_data) 
			{

				$new_id = '';
				foreach ($widget_data as $k => $v) 
				{
					// only remapping the categories
					if (!in_array($k, array('cats', 'cat_1', 'cat_2', 'cat_3', 'cat', 'categories', 'category'))) {
						continue;
					}

					// perhaps the value is a category id
					if (!empty($v) && is_numeric($v) && !empty($this->wp_import->processed_terms[$v])) {
						$new_id = $this->wp_import->processed_terms[$v];
					}

					$data['widgets'][$widget][$k] = $new_id;

				} // end widgets data keys loop
			} // end main widgets loop


			// update meta with new associations
			if ($orig_data != $data) {
				update_post_meta($post_id, $meta_key, $data);
			}
		}
	}

	/**
	 * Configure main navigation menu
	 */
	public function configure_menu()
	{

		/*
		 * Set the menu to the correct location 
		 */

		// get registered menus
		$locations  = get_theme_mod('nav_menu_locations');
		$menus = wp_get_nav_menus();
		
		if (!empty($menus))
		{
			foreach($menus as $menu)
			{
				if (is_object($menu) && $menu->name == apply_filters('flipmag_import_main_menu', 'Main Menu'))
				{
					$locations['main'] = $menu->term_id;
				}
			}
		}

		// set the menus
		set_theme_mod('nav_menu_locations', $locations);

		/*
		 * Setup custom menu fields as mega menu
		 */
		
		$menu_items = wp_get_nav_menu_items('main-menu');
		if (!empty($menu_items)) 
		{
			$fields = apply_filters('flipmag_import_menu_fields', array());

			foreach ($menu_items as $meta_key => $item) 
			{
				foreach ($fields as $field_key => $field_data) 
				{
					foreach ($field_data as $label => $value) {

						if ($item->title == $label) {
							update_post_meta($item->ID, '_menu_item_' . $field_key, $value);
						}
					}

				} // end fields loop
			} // end menu items loop
		}

	}

	/**
	 * Configure the static home-page 
	 */
	public function configure_home()
	{

		// set the home page
		$home = get_page_by_title('Home');

		if (is_object($home)) {
			update_option('show_on_front', 'page');
			update_option('page_on_front', $home->ID);
		}
	}
	
	/**
	 * Import theme settings and re-configure data
	 */
	public function import_theme_settings()
	{
		$data = json_decode( wp_remote_retrieve_body( wp_remote_get( $this->demo_data_url . 'settings.json' )), true);

		if( $data == null || $data == "" ){
			ob_start();
			include get_template_directory() . '/admin/demo-data/settings.json';
			$data = ob_get_clean();
			$data = json_decode( $data , true );
		}

		// remove un-necessary data
		unset($data['shortcodes']);

		// re-map category ids
		$cat_meta = array();
		foreach ($data as $key => $value) {

			if (strstr($key, 'cat_meta_')) {
				$cat_id = intval(substr($key, strlen('cat_meta_')));
				$cat_meta['cat_meta_' . $this->wp_import->processed_terms[$cat_id]] = $value;
			}
		}

		$data = array_merge($data, $cat_meta);

		// update settings and category meta
		if (count($data)) {

			// update options
			Flipmag::options()->set_all($data)->update();
		}

		// remove css cache
		delete_transient('flipmag_custom_css_cache');
	}
	
	/**
	 * Filter callback: Disable all image sizes for import purposes - needed for less powerful hosts!
	 */
	public function disable_image_sizes($sizes) {
    	return array();
	}

	/**
	 * Ensure media image sizes are default pre-import
	 */
	public function set_image_defaults() 
	{
		update_option('medium_size_w', 300);
		update_option('medium_size_h', 300);
		update_option('large_size_w', 1024);
		update_option('large_size_h', 1024);
	}
} 
