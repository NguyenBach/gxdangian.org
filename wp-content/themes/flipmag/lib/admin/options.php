<?php


class Flipmag_Admin_Options
{
	public $option_key;
	public $options;
	
	public function __construct()
	{
		$this->option_key = Flipmag::options()->get_config('theme_prefix') .'_theme_options';
		add_action('admin_menu', array($this, 'init'));
	}
	
	/**
	 * Register a single option using Setting API and use sanitization hook 
	 */
	public function init()
	{

		// current user can edit?
		if (!current_user_can('edit_theme_options')) {
			return;
		}
		
		// create link
		$title = THEMENAME. __( ' Options', 'flipmag');
		$page  = add_theme_page($title, $title, 'edit_theme_options', 'flipmag-admin-options', array($this, 'render_options'));
		//add_object_page($title, $title, 'edit_theme_options', 'flipmag-options', array($this, 'render_page'));

		add_action('admin_print_styles-' . $page, array($this, 'add_assets'));
        add_action('admin_print_styles-widgets.php' , array($this, 'add_widget_assets'));
    }
	
	/**
	 * Render page using admin/options.php setting and showing template-options.php
	 */
	public function render_options()
	{
		
		// backup?
		if (!empty($_GET['backup'])) {
			$this->export_options();
		}
		
		// get options array and initialize renderer
		$this->options = include get_template_directory() . '/admin/options.php';
		
		// update settings; check security
		if ($_POST && check_admin_referer($this->option_key . '_save')) {
			
			// delete css cache
			delete_transient('flipmag_custom_css_cache');
			
			if (!empty($_POST['update'])) {
				return $this->save_options();
			}
	
			// delete all settings
			if (!empty($_POST['delete'])) {
				return $this->delete_options();
			}
		
			// delete color settings
			if (!empty($_POST['reset-colors'])) {
				return $this->delete_options('colors');
			}
		}

		$this->_render_form();
	}

	/**
	 * Render our options form
	 * @param array $populate  an array of default values to use for elements
	 */
	public function _render_form($populate = null, $data = array())
	{
		$renderer = Flipmag::factory('admin/option-renderer'); /* @var $renderer Flipmag_Admin_OptionRenderer */
		
		$renderer->template(
			$this->options, 
			locate_template('/admin/template-options.php'),
			array_merge(Flipmag::options()->get_all(), (array) $populate), // get database values and override with provided $populate (usually $_POST)
			array_merge($data, array('option_key' => $this->option_key))
		);
	}
	
	public function add_assets()
	{
        wp_enqueue_style('jquery-options-css', get_template_directory_uri() . '/admin/css/chosen.jquery.css');
        wp_enqueue_script('jquery-chosen-js', get_template_directory_uri() . '/admin/js/chosen.jquery.js', array('jquery'));

        wp_enqueue_style('theme-options-css', get_template_directory_uri() . '/admin/css/options.css');
        wp_enqueue_script('theme-spectrum', get_template_directory_uri() . '/admin/js/spectrum.js', array('jquery'));
        wp_enqueue_script('theme-options-js', get_template_directory_uri() . '/admin/js/options.js', array('jquery'));
        add_editor_style( get_template_directory_uri() . '/admin/css/options.css' );

		// @todo: make optional
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		// wp_enqueue_style('farbtastic');
		// wp_enqueue_script('farbtastic');

		// add media scripts
		wp_enqueue_media();
		
	}

    public function add_widget_assets()
    {
        wp_enqueue_style('jquery-options-css', get_template_directory_uri() . '/admin/css/chosen.jquery.css');
        wp_enqueue_script('jquery-chosen-js', get_template_directory_uri() . '/admin/js/chosen.jquery.js', array('jquery'));

        wp_enqueue_script('theme-options-js', get_template_directory_uri() . '/admin/js/options.js', array('jquery'));

        // @todo: make optional
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');

        wp_enqueue_style('farbtastic');
        wp_enqueue_script('farbtastic');

        // add media scripts
        wp_enqueue_media();

    }

	/**
	 * Extract elements/fields from the options hierarchy
	 * 
	 * @param array $options
	 * @param boolean $sub  add partial sub-elements in the list
	 * @param string  $tab_id  filter using a tab id
	 */
	public function get_elements_from_tree(array $options, $sub = false, $tab_id = null)
	{
		$elements = array();
		
		foreach ($options as $tab) {
			
			if ($tab_id != null && $tab['id'] != $tab_id) {
				continue;
			}
			
			foreach ($tab['sections'] as $section) 
			{
				foreach ($section['fields'] as $element) 
				{
					// pseudo element?
					if (empty($element['name'])) {
						continue;
					}
					
					$elements[$element['name']] = $element;
					
					// special treatment for typography section - it has sub-options
					if ($sub === true && $element['type'] == 'typography') {
						
						if (!empty($element['color'])) {
							// over-write 'value' key from the one in color - to set proper default
							$elements[$element['name'] . '_color'] = array_merge($element, $element['color']);
						}
						
						if (!empty($element['size'])) {
							$elements[$element['name'] . '_size'] = array_merge($element, $element['size']);
						}
					}
					
					// special treatment for typography section - it has sub-options
					if ($sub === true && $element['type'] == 'upload') {
						
						if (!empty($element['bg_type'])) {
							// over-write 'value' key from the one in color - to set proper default
							$elements[$element['name'] . '_bg_type'] = array_merge($element, $element['bg_type']);
						}
					}
					
				} // end fields loop
				
			} // end sections
		}
		
		return $elements;
	}
	
	/**
	 * Delete / reset options - security checks done outside
	 */
	public function delete_options($type = null)
	{
		// get options object
		$options_obj = Flipmag::options();
		
		if ($type == 'colors') 
		{
			$elements = $this->get_elements_from_tree($this->options, true, 'options-style-color');
			
			// preserve this
			unset($elements['oc_predefined_style']);
		}
		else 
		{
			$elements = $this->get_elements_from_tree($this->options, true);
		}
		
		// loop through all elements and reset them
		foreach ($elements as $key => $element) {
			$options_obj->set($key, null); // unset / reset
		}

		// save in database
		$options_obj->update();
		
		// render populated form
		$this->_render_form(null, array('options_deleted' => true));
	}
	
	/**
	 * Save options submitted via normal post - security checks done outside
	 *
	 */
	public function save_options()
	{
		// importing options
		if (isset($_FILES['import_backup']) && is_uploaded_file($_FILES['import_backup']['tmp_name'])) {
			return $this->import_options();
		}
				
		$options  = array();
		$elements = $this->get_elements_from_tree($this->options, true);
		
		$options_obj = Flipmag::options();
		
		$options_saved = false;
		
		// remove magic quote slashes
		$_POST = stripslashes_deep($_POST);

		foreach ($elements as $key => $element) 
		{
            if( isset($_POST[$key]) ){
				// data available? save only if not the same as default
				$value = $_POST[$key];
					
				if (isset($value) && (!isset($element['value']) OR $element['value'] != $value)) {
					$options[$key] = $_POST[$key]; 	
				}
				// unset this option - default? n/a
				else {
					$options_obj->set($key, null);
				}
            }
		}
		$result = $this->_validate_sanitize_options($options, $elements);

		if ($result['errors']) {
			$form_errors = $result['errors'];
		}
		else {
			
			$options = apply_filters('flipmag_options_presave', $result['options']); // sanitized
						
			// update elements
			foreach ($options as $key => $value) {
				$options_obj->set($key, $value);
			}

			// save in database
			$options_obj->update();
			
			$options_saved = true;
			
			// flush widgets cache
			do_action('flipmag_widget_flush_cache');
		}
		
		// render populated form
		$this->_render_form($_POST, compact('options_saved', 'form_errors'));
	}
	
	/**
	 * Download / export options
	 */
	public function export_options()
	{
		$options = json_encode(Flipmag::options()->get_all());
		
		// send file
		header('Content-type: application/json');
		header('Content-Disposition: attachment; filename="options_panel_backup_'. time() .'.json"');
			
		die($options);
	}
	
	/**
	 * Import options from a backup file
	 */
	public function import_options()
	{
		$file = wp_handle_upload($_FILES['import_backup'], array('test_form' => false, 'test_type' => false));
		$form_data = $_POST;

		$options_saved = false;
		
		// no errors?
		if (!empty($file['error'])) {
			$form_errors = array($file['error']);
		}
		else {
			
			// import data
			$data = wp_remote_retrieve_body( wp_remote_get($file['url'], array( 'timeout' => 120, 'httpversion' => '1.1' ) ));
			$data = json_decode($data, true);
			

			if (is_array($data)) {
				
				// update options
				Flipmag::options()->set_all($data)->update();
				
				$form_data = $data;
				$options_saved = true;
			}
			else {
				$form_errors = array(__('Could not import options. Are you sure the uploaded file was a valid backup file?',  'flipmag'));
			}
			
			// remove temporary backup file
			@unlink($file['file']);
		}
		
		// render form
		return $this->_render_form($form_data, compact('options_saved', 'form_errors'));
	}
	
	/**
	 * Validate and sanitize options
	 * 
	 * @param array $options  array of options key => value pairs
	 * @param array $elements array with elements and their configuration
	 * @return array errors and options keys
	 */
	public function _validate_sanitize_options($options, $elements)
	{
		$errors = array();
		
		foreach ($options as $key => $value)
		{ 
			$element  = $elements[$key];
			switch ($element['type'])
			{				
				case 'checkbox':					
				case 'radio':
				case 'select':
					
					// checkboxes support 0 or 1
					if ($element['type'] == 'checkbox') {
						$element['options'] = array(0 => '', 1 => '');
						
						if (is_array($value)) {
							$options[$key] = array_filter($value);
							break; 
						}
						
					}
					
					// other elements need options
					if (!array_key_exists($value, (array) $element['options'])) {
						$errors[] = esc_html(sprintf('"%s" is not a valid option for element %s (%s)', $value, $element['label'], $key));
					}
					
					break;
					
				case 'text':
				case 'textarea':
				case 'color':
					
					// by default, support html sanitization
					if (empty($element['strip']) OR $element['strip'] == 'bad_html') {
						// sanitize
						$options[$key] = wp_kses_post($value);
					}
					// text only
					else if ($element['strip'] == 'all_html') {
						$options[$key] = strip_tags($value);
					}
			}
			
		}
		
		return compact('errors', 'options');
	}	
}