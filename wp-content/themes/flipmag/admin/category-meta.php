<?php
/**
 * Category meta template.
 * 
 * WARNING: Include it in an action callback only. 
 */

// editing?
$meta = array('feature_style' => '', 
	'feature_wrap' => '',
	'featured_overlay' => '',
	'template' => '', 
	'sidebar' => '', 
	'bg_image' => '', 
	'slider' => '', 
	'per_page' => '', 
	'color' => '', 
	'oc_pagination_type' => '',
	'animation' => '', 
	'disable_date' => '', 
	'date_format' => '', 
	'date_link' => '', 
	'disable_cat' => '', 
	'disable_comment' => '', 
	'disable_author' => '', 
	'disable_excerpt' => '', 
	'excerpt_length' => '', 
	'disable_more' => '' 
);

if (is_object($term)) {
	$meta = array_merge($meta, (array) Flipmag::options()->get('cat_meta_' . $term->term_id));
}

$render = Flipmag::factory('admin/option-renderer'); /* @var $render Flipmag_Admin_OptionRenderer */

?>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[template]"><?php _e('Category Listing Style', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[template]',
				'options' => array(
					'' => __('Default Style (In Theme Settings)', 'flipmag'),
					'block_1' => __('Block 1', 'flipmag'),
                    'block_2' => __('Block 2', 'flipmag'),
                    'block_3'  => __('Block 3', 'flipmag'),
                    'block_4'  => __('Block 4', 'flipmag'),
                    'block_5'  => __('Block 5', 'flipmag'),
                    'block_6'  => __('Block 6', 'flipmag'),
                    'block_7'  => __('Block 7', 'flipmag'),
                    'block_8'  => __('Block 8', 'flipmag'),
                    'block_9'  => __('Block 9', 'flipmag'),
                    'block_10'  => __('Block 10', 'flipmag'),
                    'block_11'  => __('Block 11', 'flipmag'),
                    'block_12'  => __('Block 12', 'flipmag'),
                    'block_13'  => __('Block 13', 'flipmag'),
                    'block_14'  => __('Block 14', 'flipmag'),
                    'block_15'  => __('Block 15', 'flipmag'),
                    'block_16'  => __('Block 16', 'flipmag'),
                    'block_17'  => __('Block 17', 'flipmag'),
                    'block_18'  => __('Block 18', 'flipmag'),
                    'block_19'  => __('Block 19', 'flipmag'),
                    'block_20'  => __('Block 20', 'flipmag'),
				),
				'value' => $meta['template'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Select a template to use for this category', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[sidebar]"><?php _e('Show Sidebar?', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[sidebar]',
				'options' => array('' => __('Default', 'flipmag'), 'none' => __('No Sidebar', 'flipmag'), 'right' => __('Right Sidebar', 'flipmag'), 'left' => __('Left Sidebar', 'flipmag')),
				'value' => $meta['sidebar'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Select layout sidebar preference for this category\'s listing.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[slider]"><?php _e('Featured Slider?', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[slider]',
				'options' => array(
					'' => __('Disabled', 'flipmag'),
					'default' => __('Show Posts Marked for Featured Slider', 'flipmag'),
					'latest' => __('Show Latest Posts', 'flipmag'),
				),
				'value' => $meta['slider'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Featured slider will display on category listing.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[feature_style]"><?php _e('Featured Style', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[feature_style]',
				'options' => array(
					'1'	=> __('Feature 1', 'flipmag'),
                    '2'	=> __('Feature 2', 'flipmag'),
                    '3'	=> __('Feature 3', 'flipmag'),
                    '4'	=> __('Feature 4', 'flipmag'),
                    '5'	=> __('Feature 5', 'flipmag'),
                    '6'	=> __('Feature 6', 'flipmag'),
                    '7'	=> __('Feature 7', 'flipmag'),
				),
				'value' => $meta['feature_style'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Change different feature styles.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[feature_wrap]"><?php _e('Featured Wrapper', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[feature_wrap]',
				'options' => array(
					'yes'	=> __('Yes', 'flipmag'),
                    'no'	=> __('No', 'flipmag'),                    
				),
				'value' => $meta['feature_wrap'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Used wrapper for feature style.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[featured_overlay]"><?php _e('Featured Overlay', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[featured_overlay]',
				'options' => array(
					'0'	=> __('No', 'flipmag'),
					'1'	=> __('Yes', 'flipmag'),             
				),
				'value' => $meta['featured_overlay'],
			)));
		?>		
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[per_page]"><?php _e('Posts Per Page (Optional)', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_text(array(
				'name' => 'meta[per_page]',
				'value' => $meta['per_page'],
				'input_type'  => 'number',
				'input_class' => 'input-number',
			)));
		?>
		<p class="description custom-meta"><?php printf(
			__('Override default posts per page setting for this category. Leave empty for default (from Settings > Reading): %s', 'flipmag'),
			esc_attr(get_option('posts_per_page'))); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[oc_pagination_type]"><?php _e('Pagination Type', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[oc_pagination_type]',
				'options' => array(
					'' => __('Default', 'flipmag'),
					'normal' => __('Normal', 'flipmag'),                                        
					'infinite' => __('Infinite Scroll', 'flipmag'),
				),
				'value' => $meta['oc_pagination_type'],
			)));
		?>
		<p class="description custom-meta"><?php _e('Infinite scroll can be globally enabled/disabled from Theme Settings.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[color]"><?php _e('Category Color', 'flipmag'); ?></label></th>
	<td>
		<input type="text" name="meta[color]" class="colorpicker" value="<?php echo esc_html($meta['color']); ?>" data-default-color="<?php echo esc_attr(Flipmag::options()->css_main_color); ?>" />
		<p class="description custom-meta"><?php _e('FlipMag uses this in several areas such as navigation and homepage blocks.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[animation]"><?php _e('Animation', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[animation]',
				'options' => array(
                        '' => __('Default', 'flipmag'),
						'none' => __('None', 'flipmag'),
                        'fadeInDown animation' => __('Fade In Down', 'flipmag'),
                        'fadeInUp animation' => __('Fade In Up', 'flipmag'),
                        'fadeInLeft animation' => __('Fade In Left', 'flipmag'),
                        'fadeInRight animation' => __('Fade In Right', 'flipmag')
				),
				'value' => $meta['animation'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Give animation effect to selected category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_date]"><?php _e('Disable Date', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_date]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'yes' => __('Yes', 'flipmag'),
                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_date'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Disable date in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[date_format]"><?php _e('Date Format', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[date_format]',
				'options' => array(
                    'default' => __('Default', 'flipmag'),
					'' => sprintf(__('JANUARY 25, %s', 'flipmag'), date('Y')),
					'F jS, Y' => sprintf(__('JANUARY 25TH, %s' , 'flipmag'), date('Y')),
					'j F, Y' => sprintf(__('25 JANUARY, %s' , 'flipmag'), date('Y')),
					'jS F, Y' => sprintf(__('25TH JANUARY, %s' , 'flipmag'), date('Y')),
					'M j, Y' => sprintf(__('JAN 25, %s' , 'flipmag'), date('Y')),
					'M jS, Y' => sprintf(__('JAN 25TH, %s', 'flipmag'), date('Y')),
					'j M, Y' => sprintf(__('25 JAN, %s' , 'flipmag'), date('Y')),
					'jS M, Y' => sprintf(__('25TH JAN, %s', 'flipmag'), date('Y')),
					'd-m-Y' => sprintf(__( '25-1-%s' , 'flipmag'), date('Y')),
					'd/m/Y' => sprintf(__( '25/1/%s' , 'flipmag'), date('Y')),
					'Y-m-d' => sprintf(__( '%s-1-25' , 'flipmag'), date('Y')),
					'Y/m/d' => sprintf(__( '%s/1/25' , 'flipmag'), date('Y')),
				),
				'value' => $meta['date_format'],
			)));
		?>		
            <p class="description custom-meta"><?php sprintf( _e('Choose date format to category block. example date is JANUARY 25 %s', 'flipmag'), date('Y') ); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[date_link]"><?php _e('Date Link', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[date_link]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'day' => __('Day', 'flipmag'),
                    'month' => __('Month', 'flipmag'),
                    'year' => __('Year', 'flipmag'),
				),
				'value' => $meta['date_link'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Set date href link to archive date.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_cat]"><?php _e('Disable Category', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_cat]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'yes' => __('Yes', 'flipmag'),
                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_cat'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Enable/Disable category in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_comment]"><?php _e('Disable Comment', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_comment]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'yes' => __('Yes', 'flipmag'),
                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_comment'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Enable/Disable comments in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_author]"><?php _e('Disable Author', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_author]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'yes' => __('Yes', 'flipmag'),
                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_author'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Enable/Disable author in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_excerpt]"><?php _e('Disable Excerpt', 'flipmag'); ?></label></th>
	<td>
		<?php 
			echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_excerpt]',
				'options' => array(
                    '' => __('Default', 'flipmag'),
                    'yes' => __('Yes', 'flipmag'),
                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_excerpt'],
			)));
		?>		
            <p class="description custom-meta"><?php _e('Enable/Disable excerpt in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[excerpt_length]"><?php _e('Excerpt Length', 'flipmag'); ?></label></th>
	<td><?php                 
            echo wp_kses_stripslashes($render->render_text(array(
				'name' => 'meta[excerpt_length]',
				'value' => $meta['excerpt_length'],
				'input_type'  => 'number',
				'input_class' => 'input-number',
			)));
                
		?>		
        <p class="description custom-meta"><?php _e('Set excerpt length in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[disable_more]"><?php _e('Disable Read More (If excerpt enable)', 'flipmag'); ?></label></th>
	<td><?php 
            echo wp_kses_stripslashes($render->render_select(array(
				'name' => 'meta[disable_more]',
				'options' => array(
                                    '' => __('Default', 'flipmag'),
                                    'yes' => __('Yes', 'flipmag'),
                                    'no' => __('No', 'flipmag'),
				),
				'value' => $meta['disable_more'],
			)));
		?>		
        <p class="description custom-meta"><?php _e('Enable/Disable read more button in category block.', 'flipmag'); ?></p>
	</td>
</tr>

<?php if (Flipmag::options()->oc_layout_style == 'boxed'): ?>
<tr class="form-field">
	<th scope="row" valign="top"><label for="meta[bg_image]"><?php _e('Category Background', 'flipmag'); ?></label></th>
	<td><?php 
		echo wp_kses_stripslashes($render->render_upload(array(
			'name'  => 'meta[bg_image]',
			'value' => $meta['bg_image'],
			'options' => array(
				'type'  => 'image',
				'title' => __('Upload This Picture', 'flipmag'), 
				'button_label' => __('Upload',  'flipmag'),
				'insert_label' => __('Use as Background',  'flipmag')
			),
		)));
		?>
	<p class="description custom-meta"><?php 
		_e('FlipMag can use an image as body background in boxed layout. Note: It is not a repeating pattern. A large photo is to be used as background.', 'flipmag'); ?></p>
	</td>
</tr>

<?php endif; ?>