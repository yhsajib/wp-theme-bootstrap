<div class="yhsshu-dashboard-wrap">
	<?php require get_template_directory() . '/inc/admin/views/admin-tabs.php'; ?>
	<?php 
	$installed_plugins = get_plugins();
	$plugins = TGM_Plugin_Activation::$instance->plugins;
	$yhsshu_import_demo_id = get_option('yhsshu_import_demo_id','');
	$plugin_requires = array();
	foreach( $plugins as $plugin ){
		$file_path = $plugin['file_path'];
		
		$this_active =  in_array( $plugin['file_path'], (array) get_option( 'active_plugins', array() ), true ) || is_plugin_active_for_network( $plugin );

		if( $plugin['required'] === true && !$this_active){
			$plugin_requires[] = $plugin['name'];
		}
	}  
	?>
	<?php 
 	$dev_mode = apply_filters( 'yhsshu_set_dev_mode', (defined('DEV_MODE') && DEV_MODE)) ;
	if ( 'valid' != get_option( yhsshu()->get_slug().'_purchase_code_status', false ) && !$dev_mode ) :
		
		echo '<div class="error"><p>' .
				sprintf( wp_kses_post( esc_html__( 'The %s theme needs to be registered. %sRegister Now%s', 'yhsshu' ) ), yhsshu()->get_name(), '<a href="' . admin_url( 'admin.php?page=yhsshu') . '">' , '</a>' ) . '</p></div>';
	elseif( !empty($plugin_requires) && sizeof($plugin_requires) >= 1 ):

		echo '<div class="error">';
		echo sprintf( wp_kses_post( esc_html__( 'Make sure to activate required plugins prior to import a demo to %s. %sActive Now%s', 'yhsshu' ) ), yhsshu()->get_name(), '<a class="nt-atpli" href="' . admin_url( 'admin.php?page=yhsshu-plugins') . '">' , '</a>' );
		echo '<ul class="plugin-not-active">';
			foreach( $plugin_requires as $pr ){
				echo '<li>'.$pr.'</li>';
			}
		echo '</ul>';
		echo '</div>';
	else: ?>

	<header class="yhsshu-dsb-header">
		<div class="yhsshu-dsb-header-inner">
			<h4><?php esc_html_e( 'Import a Demo', 'yhsshu' ); ?></h4>
			<p><?php esc_html_e( 'Choose a pre-built website for starting a quick design process.', 'yhsshu' ) ?></p>
		</div>
		<div class="yhsshu-msg yhsshu-dsb-notice">
			<p><span><?php esc_html_e( 'Note:', 'yhsshu' ); ?></span> <?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'yhsshu' ) ?></p>
		</div>
	</header>

	<?php

		require locate_template( 'inc/admin/demo-data/demo-config.php' );
		$i = 0;
		wp_localize_script( 'yhsshu-admin', 'yhsshu_demos', $demos );

		?>
		<div id="yhsshu-demos" class="yhsshu-demos yhsshu-solid-wrap">

			<div class="yhsshu-tab-nav">
				<ul>
					<li><a class="active" href="#yhsshu-demos-elementor" data-filter="elementor">Elementor</a></li>
					<li><a href="#yhsshu-demos-wpbakery" data-filter="wpbakery">WPBakery</a></li>
				</ul>
			</div>

			<div class="yhsshu-tab-content">
				<div class="yhsshu-row">
					<?php foreach( $demos as $id => $demo ): ?>

					<div class="yhsshu-col yhsshu-col-4 <?php echo !empty($demo['builder']) ? esc_attr($demo['builder']) : esc_attr('elementor'); ?>">
			
						<div class="yhsshu-dsb-demo-item">

							<figure>
								<img src="<?php echo esc_url( $demo['screenshot'] ); ?>" alt="<?php echo esc_attr( $demo['title'] ); ?>">
								<div class="yhsshu-dsb-overlay">
									<a href="#" id="import-id" data-import-id="<?php echo esc_attr( $i ); ?>" data-demo-id="<?php echo esc_attr( $id ); ?>" class="yhsshu-btn yhsshu-popup-import <?php echo esc_attr( $id ); ?>">
										<span><?php esc_html_e( 'Import Demo', 'yhsshu' ); ?></span>
									</a>
									<a target="_blank" href="<?php echo esc_url( $demo['preview'] ); ?>" class="yhsshu-btn yhsshu-preview-btn">
										<span><?php esc_html_e( 'Preview', 'yhsshu' ); ?></span>
										<span class="yhsshu-btn-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
										</span>
									</a>
								</div>
							</figure>
							<h3><?php echo esc_html( $demo['title'] ); ?></h3>
						</div>
					</div>

					<?php $i++; ?>
					<?php endforeach; ?>

				</div>
			</div>
	</div>
	
	<div class="yhsshu-demo-content yhsshu-imp-popup-wrap">
		<div class="yhsshu-imp-popup-inner">
			<span class="yhsshu-imp-popup-close"></span>
			<div class="yhsshu-imp-popup-content">
				<h4 style="text-align:center; margin-bottom: 30px;"><?php esc_html_e( 'Select all or a few', 'yhsshu' ); ?></h4>
				<div class="yhsshu-row">
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-media" type="checkbox" value="import_media" checked="">
							<label for="yhsshu-imp-media"></label>
							<span><?php esc_html_e( 'Media Attachments', 'yhsshu' ); ?></span>
						</span>
					</div>
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-content" type="checkbox" value="import_content" checked="">
							<label for="yhsshu-imp-content"></label>
							<span><?php esc_html_e( 'Content', 'yhsshu' ); ?></span>
						</span>
					</div>
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-options" type="checkbox" value="import_theme_options" checked="">
							<label for="yhsshu-imp-options"></label>
							<span><?php esc_html_e( 'Theme Options', 'yhsshu' ) ?></span>
						</span>
					</div>
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-widgets" type="checkbox" value="import_widgets" checked="">
							<label for="yhsshu-imp-widgets"></label>
							<span><?php esc_html_e( 'Widgets', 'yhsshu' ); ?></span>
						</span>
					</div>
					<?php if(!empty($plugins['revslider'])): ?>
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-revslider" type="checkbox" value="import_slider" checked="">
							<label for="yhsshu-imp-revslider"></label>
							<span><?php esc_html_e( 'Revslider', 'yhsshu' ); ?></span>
						</span>
					</div>
						<?php endif; ?>
					<div class="yhsshu-col yhsshu-col-6">
						<span class="yhsshu-imp-opt">
							<input id="yhsshu-imp-settings" type="checkbox" value="import_settings" checked="">
							<label for="yhsshu-imp-settings"></label>
							<span><?php esc_html_e( 'Settings', 'yhsshu' ) ?></span>
						</span>
					</div>
				</div>
				<div class="yhsshu-row" style="padding-top: 30px;">
					<div class="yhsshu-col yhsshu-col-12">
						<div class="yhsshu-imp-skip-posts">
							<span class="yhsshu-imp-opt-skip-posts" style="margin-bottom: 0; padding-left: 15px;">
								<input id="yhsshu-imp-skip-posts-existen" name="skip_posts_existen" type="checkbox" value="skip-posts-existen">
								<label for="yhsshu-imp-skip-posts-existen">
								<span><?php esc_html_e( 'Skip the posts existen, ( Default clear all content ).', 'yhsshu' ); ?></span>
								</label>
							</span>
						</div>
						<div class="yhsshu-imp-crop">
							<span class="yhsshu-imp-opt-crop" style="margin-bottom: 0; padding-left: 15px;">
								<input id="yhsshu-imp-crop-img" name="crop-img" type="checkbox" value="crop_img" checked="">
								<label for="yhsshu-imp-crop-img"></label>
								<span><?php esc_html_e( 'Crop Image after import finish?', 'yhsshu' ); ?></span>
							</span>
						</div>
						<button class="yhsshu-import-btn" data-id="0">
							<span><?php esc_html_e( 'Import Demo', 'yhsshu' ); ?></span>
						</button>
					</div>
				</div>
			</div>
		  
		</div>
	</div>
	<div class="yhsshu-progress-popup yhsshu-imp-popup-wrap">
		<div class="yhsshu-imp-progress">
			<h6><?php esc_html_e( 'Importing...', 'yhsshu' ); ?></h6>
			<div class="yhsshu-progress importing"><?php esc_html_e( 'Working', 'yhsshu' )?> <span>.</span><span>.</span><span>.</span></div>
			<div class="yhsshu-progressbar">
				<div class="yhsshu-progressbar-inner" style="width: 0%">
					<span class="yhsshu-loader yhsshu-progressbar-percentage"><?php esc_html_e( '0%', 'yhsshu' ); ?></span>
				</div>
			</div>
		</div>
	</div> 
	<?php endif; ?>
</div>
