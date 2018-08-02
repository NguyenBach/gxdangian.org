<?php
/**
 * Generic HTML Markup generator methods
 */

class Flipmag_Markup
{

	/**
	 * Output attributes
	 *  
	 * @param string $id         unique id to use in filters  
	 * @param array  $attributes associative array of attributes
	 * @param array  $options    method configs
	 */
	public function attribs($id, $attributes = array(), $options = array())
	{
		
		$options = wp_parse_args($options, array('echo' => true));
		
		$attributes = apply_filters('flipmag_attribs_' . $id, $attributes);
		
		// generate the output string
		$attribs = '';
		foreach ($attributes as $key => $value) {
			
			if (is_array($value)) {
				$value = join(' ', array_filter($value));
			}
			
			// html5 supports attributes of type itemscope, checked without value
			if (empty($value)) {
				$attribs .= ' ' . esc_html($key);
				continue;
			}
			
			$attribs .=  sprintf(' %s="%s"', esc_html($key), esc_attr($value));
		}
		
		// remove starting space
		$attribs = ltrim($attribs);
		
		if ($options['echo']) {
			echo esc_html($attribs);
		}
		
		return $attribs;
	}
	
	/**
	 * Get a unique id to be used mainly in blocks
	 * 
	 * WARNING: Not persistent - will change with request order.
	 * 
	 * @param string   $prefix          a prefix for internal distinction and for output unless disabled  
	 * @param boolean  $return_id_only  return id without prefix
	 */
	public function unique_id($prefix = '', $return_id_only = false)
	{
		// get item from registry
		$ids = (array) Flipmag::registry()->flipmag_markup_ids;
		$key = $prefix ? $prefix : 'default';
		
		if (!isset($ids[$key])) {
			$ids[$key] = 0;
		}
		
		$ids[$key]++;
		
		// update registry
		Flipmag::registry()->set('flipmag_markup_ids', $ids);
		
		return ($return_id_only ? '' : $prefix) . $ids[$key];
	}
	
}