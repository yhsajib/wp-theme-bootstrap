<div class="yhsshu-social-icons layout-1">
	<?php 
		foreach ($settings['social_list'] as $value): 
			$link_attrs = [];
			if ( ! empty( $value['social_link']['url'] ) ) {
				$link_attrs['href'] = $value['social_link']['url'];
			}
		    if ( ! empty($value['social_link']['is_external'] )) {
		        $link_attrs['target'] = '_blank';
		    }
		    if ( ! empty($value['social_link']['nofollow'] )) {
		        $link_attrs['rel'] = 'nofollow';
		    }
		    if( ! empty($value['social_link']['custom_attributes'])){
		    	$custom_attributes = explode('|', $value['social_link']['custom_attributes']);
		    	foreach ($custom_attributes as $atts_value) {
		    		$_custom_attributes = explode(':', $atts_value);
		    		$link_attrs[$_custom_attributes[0]] = $_custom_attributes[1];
		    	}
		    }
			Elementor\Icons_Manager::render_icon( 
				$value['social_icon'], 
				array_merge([ 'aria-hidden' => 'true', 'class' => 'social-item yhsshu-icon'],$link_attrs), 
				'a'
			);
		endforeach; 
	?>
</div>