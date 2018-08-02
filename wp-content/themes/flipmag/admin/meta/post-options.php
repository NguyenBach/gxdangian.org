<?php

$options = array(

	array(
		'label' => __('Featured Post?', 'flipmag'),
		'name'  => 'featured_post', // _flipmag_featured_post
		'type'  => 'checkbox',
		'value' => 0
	),
	
        array(
		'label' => __('Post Layout', 'flipmag'),
		'name'  => 'layout_template', // will be _bunyad_layout_style
		'type'  => 'select',
		'options' => array(
			'' => __('Default (from Theme Settings)', 'flipmag'),
			'classic' => __('Classic', 'flipmag'),
			'cover' => __('Post Cover', 'flipmag'),
                        'full-cover' => __('Post Full Cover', 'flipmag'),
			'classic-above' => __('Classic - Title First', 'flipmag'),
		),
		'value' => '' // default
	),
	
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
		'label' => __('Category Label Overlay', 'flipmag'),
		'name'  => 'cat_label', // _flipmag_cat_label
		'type'  => 'html',
		'html' =>  wp_dropdown_categories(array(
			'show_option_all' => __('-- Auto Detect--', 'flipmag'), 
			'hierarchical' => 1, 'order_by' => 'name', 'class' => '', 
			'name' => '_flipmag_cat_label', 'echo' => false,
			'selected' => Flipmag::posts()->meta('cat_label')
		)),
		'desc' => __('When you have multiple categories for a post, auto detection chooses one in alphabetical order. These labels are shown above image in category listings.', 'flipmag')
	),
	
	array(
		'label' => __('Multi-page Content Slideshow?', 'flipmag'),
		'desc' => __('You can use <!--nextpage--> to split a page into multi-page content slideshow.', 'flipmag'),
		'name'  => 'content_slider', // _flipmag_featured_post
		'type'  => 'select',
		'value' => 0,
		'options' => array(
			'' => __('Disabled', 'flipmag'),
			'ajax' => __('AJAX - No Refresh', 'flipmag'),
			'refresh'  => __('Multi-page - Refresh for next page', 'flipmag'), 
		),
	),
	
	
	array(
		'label_left' => __('Disable Featured?', 'flipmag'),
		'label' => __('Do not show featured Image, Video, or Gallery at the top for this post, on post page.', 'flipmag'),
		'name'  => 'featured_disable', // _flipmag_featured_post
		'type'  => 'checkbox',
		'value' => 0
	),
	
	array(
		'label' => __('Featured Video Code', 'flipmag'),
		'name'  => 'featured_video', // will be _flipmag_layout_style
		'type'  => 'textarea',
		'options' => array('rows' => 7, 'cols' => 90),
		'value' => '',
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

$options = $this->options($options);
?>

<div class="flipmag-meta cf">
<?php foreach ($options as $element): ?>	
	<div class="option">
		<span class="label"><?php echo esc_html(isset($element['label_left']) ? $element['label_left'] : $element['label']); ?></span>
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