<?php

class Flipmag_Admin_ShortCodes
{
	public function __construct()
	{
		if (!current_user_can('edit_pages') && !current_user_can('edit_posts')) {
			return;
		}
		
		add_filter('mce_buttons', array($this, 'tinymce_button'));
		add_filter('mce_external_plugins', array($this, 'tinymce_plugin'));
		
		
		// add dynamic js handlers (via admin-ajax.php)
		require_once dirname(__FILE__) . '/admin/tinymce/shortcode-popup.php';
		require_once dirname(__FILE__) . '/admin/tinymce/editor-plugin.php';
		
		add_action('wp_ajax_flipmag_shortcode_popup', 'flipmag_shortcode_popup');
		add_action('wp_ajax_flipmag_shortcode_editor_plugin', 'flipmag_shortcode_editor_plugin');
	}
	
	/**
	 * Callback: Add shortcode list button to tinymce
	 * 
	 * @param array $buttons
	 */
	public function tinymce_button($buttons)
	{
		array_push($buttons, 'separator', 'flipmag_shortcodes');
		return $buttons;
	}
	
	/**
	 * Callback: Register tinyMCE custom plugin
	 * 
	 * @param array $plugins
	 */
	public function tinymce_plugin($plugins)
	{
		//$plugins['flipmag_shortcodes'] = plugin_dir_url(__FILE__). 'admin/tinymce/editor-plugin.js.php';
		$plugins['flipmag_shortcodes'] = admin_url('admin-ajax.php') . '?action=flipmag_shortcode_editor_plugin';
		return $plugins;
	}
}