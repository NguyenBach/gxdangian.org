<?php

$js_events = array();

?>
<div class="wrap" id="flipmag-options">
    
	<form method="post" action="" id="flipmag-options-form" enctype="multipart/form-data">
		<?php echo wp_nonce_field($option_key . '_save'); ?>	
            
	<header class="options-main-head">
                <div class="logo">
                    <h2><?php echo THEMENAME; ?></h2>
                    <span><?php _e('Theme Option', 'flipmag'); ?> <?php echo THEMEVERSION; ?></span><?php submit_button(__( 'Save Settings', 'flipmag'), 'primary', 'update'); ?>
                </div>
	</header>
	
	<div class="options-main">
		<ul class="tabs">		
		<?php foreach ($options as $tab): ?>		
			<li><a href="#" id="<?php echo esc_attr($tab['id']); ?>"><?php 
				if (!empty($tab['icon'])) {
					echo '<div class="dashicons ' . esc_attr($tab['icon']) . '"></div> ';	
				}				
				echo esc_html($tab['title']); ?></a></li>	
		<?php endforeach; ?>		
		</ul>		
	
		<div class="form-sections">	
	<?php if (isset($options_saved) && $options_saved === true): ?>
		<div class="success updated settings-error"><p><?php _e('Options saved!', 'flipmag'); ?></p></div>
	<?php elseif (!empty($options_deleted)): ?>
		<div class="success updated settings-error"><p><?php _e('Options reset to defaults.', 'flipmag'); ?></p></div>
	<?php elseif (!empty($form_errors)): ?>
		<div class="error settings-error">
			<p><strong><?php _e('Errors:', 'flipmag'); ?></strong></p>
			<p><?php echo implode('<br />', $form_errors); ?></p>
		</div>
	<?php endif;?>		
		<?php $n = 0; 
			$allowed = array( 'a' => array('href' => array() ),
							'br' => array(),
							'hr' => array(),
							'strong' => array(),
							'h3' => array('style' => array()),
							'div' => array('class' => array()) );
            foreach ($options as $option_tab): ?>
			<div id="options-<?php echo esc_attr($option_tab['id']);?>" class="options-sections">				
			<?php foreach ($option_tab['sections'] as $section): ?>
				<fieldset>					
                    <?php if (!empty($section['title'])): ?>
						<legend><?php echo esc_html($section['title']); ?> <div style="float: right;" class="dashicons dashicons-arrow-down"></div></legend>
					<?php endif; ?>

					<?php if (!empty($section['desc'])): ?>
						<p class="section-desc"><?php echo esc_html($section['desc']); ?></p>
					<?php endif; ?>
					
					<?php foreach ($section['fields'] as $element): ?>						
                            <div <?php if( $n <= 1 ){ echo 'style="display:block;"'; } ?> class="element cf <?php echo esc_attr((!empty($element['name']) ? 'ele-' . $element['name'] : '')); ?>">
							<?php echo wp_kses_stripslashes($this->render($element)); ?>
                                <?php if( $element['type'] == "info" && $element['label'] != null ){ echo '<label class="element-title">'. esc_html($element['label']) .'</label>'; } ?>
							<?php if( isset($element['desc']) ){ ?>
								<div class="element-desc"><?php echo wp_kses($element['desc'],$allowed); ?></div>
							<?php } ?>
						</div>
						
					<?php 						
						if (!empty($element['events'])) {
							$js_events[$element['name']] = (array) $element['events'];
						}						
					?>						
					<?php endforeach; ?>
				</fieldset>				
			<?php $n++; endforeach; ?>			
			</div>
		<?php endforeach; ?>		
		</div>	
	</div>
			
	<footer class="options-footer">	
        <p class="submit alignleft">
			<?php submit_button(__('Reset All Settings', 'flipmag'), 'delete', 'delete', false, array(
					'data-confirm' => __('Do you really wish to reset your options to default?', 'flipmag')
				)); ?>
		</p>            
		<?php submit_button(__( 'Save Settings', 'flipmag'), 'primary', 'update'); ?>
	</footer>	
	</form>
</div>
<?php if (count($js_events)): ?>
<script>
Flipmag_Options.events = <?php echo json_encode($js_events); ?>;
</script>
<?php endif; ?>
<?php if(version_compare(phpversion(), '5.3.2', '<')): ?>
<script>
jQuery(function($) {
$("#options-sample-import").hide();
});
</script>
<?php endif; ?>
