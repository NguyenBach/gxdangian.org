<?php

/**
 * Options metabox for pages
 */
$options = array(
	array(
		'label' => __('Layout Style', 'flipmag'),
		'name'  => 'layout_style', // will be _flipmag_layout_style
		'type'  => 'radio',
		'options' => array(
			'' => __('Default', 'flipmag'),
                        'left' => __('Left Sidebar', 'flipmag'),
			'right' => __('Right Sidebar', 'flipmag'),
			'full' => __('Full Width', 'flipmag')),
		'value' => '' // default
	),
	
	array(
		'label' => __('Show Page Title?', 'flipmag'),
		'name'  => 'page_title', 
		'type'  => 'select',
		'options' => array('yes' => 'Yes', 'no' => 'No'),
		'value' => 'yes' // default
	),

	array(
		'label' => __('Show Featured Slider?', 'flipmag'),
		'name'  => 'featured_slider',
		'type'  => 'select',
		'options' => array(
			''	=> __('None', 'flipmag'),
			'default' => __('Use Posts Marked as "Featured Post?"', 'flipmag'),
			'default-latest' => __('Use Latest Posts from Whole Site', 'flipmag'),
			'posts' => __('Choose from posts query', 'flipmag'),
		),
		'value' => '' // default
	),

	array(
		'label' => __('Select Posts', 'flipmag'),
		'name'  => 'posts', 
		'type'  => 'text',
		'desc'  => __('Posts ids separated by comma.', 'flipmag'),
		'value' => '', // default
		'display' => 'none'
	),
        
    array(
		'label' => __('Featured Style', 'flipmag'),
		'name'  => 'featured_style',
		'type'  => 'select',
		'options' => array(
			'1'	=> __('Feature 1', 'flipmag'),
			'2'	=> __('Feature 2', 'flipmag'),
			'3'	=> __('Feature 3', 'flipmag'),
            '4'	=> __('Feature 4', 'flipmag'),
			'5'	=> __('Feature 5', 'flipmag'),
            '6'	=> __('Feature 6', 'flipmag'),
            '7'	=> __('Feature 7', 'flipmag'),
		),
		'value' => '1' // default
	),

	array(
		'label' => __('Featured Wrapper', 'flipmag'),
		'name'  => 'feature_wrap',
		'type'  => 'select',
		'options' => array(
			'yes'	=> __('Yes', 'flipmag'),
			'no'	=> __('No', 'flipmag'),			
		),
		'value' => 'no' // default
	),

	array(
		'label' => __('Featured Overlay', 'flipmag'),
		'name'  => 'featured_overlay',
		'type'  => 'select',
		'options' => array(
			'0'	=> __('No', 'flipmag'),
			'1'	=> __('Yes', 'flipmag'),
		),
		'value' => '1' // default
	),
    
);

if (Flipmag::options()->oc_layout_style == 'boxed') {
	
	$options[] = array(
		'label' => __('Custom Background Image', 'flipmag'),
		'name'  => 'bg_image',
		'type' => 'upload',
		'options' => array(
				'type'  => 'image',
				'title' => __('Upload This Picture', 'flipmag'), 
				'button_label' => __('Upload',  'flipmag'),
				'insert_label' => __('Use as Background',  'flipmag')
		),	
		'value' => '', // default
		'bg_type' => array('value' => 'cover'),
	);
}

$options = $this->options(apply_filters('flipmag_metabox_page_options', $options));

?>

<div class="flipmag-meta cf">
<?php foreach ($options as $element): ?>	
	<div class="option <?php echo esc_attr($element['name']); echo (@$element['display'] == "none" ? ' display-none': '' ); ?>" >
		<span class="label"><?php echo esc_html($element['label']); ?></span>
		<span class="field">
			<?php echo wp_kses_stripslashes($this->render($element)); ?>		
			<?php if (!empty($element['desc'])): ?>			
			<p class="description"><?php echo esc_html($element['desc']); ?></p>		
			<?php endif;?>		
		</span>
	</div>	
<?php endforeach; ?>
</div>

<?php wp_enqueue_script('theme-options', get_template_directory_uri() . '/admin/js/options.js', array('jquery')); ?>

<script>
/**
 * Conditional show/hide 
 */
jQuery(function($) {
	$('._flipmag_featured_slider select').on('change', function() {

		if( $(this).val() == "posts" ){
			$(".flipmag-meta .option._flipmag_posts").show();
		}else{
			$(".flipmag-meta .option._flipmag_posts").hide();
		}

		return;
	});
	// on-load
	$('._flipmag_featured_slider select').trigger('change');		
});
</script>