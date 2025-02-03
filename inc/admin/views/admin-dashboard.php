<main>

	<div class="yhsshu-dashboard-wrap">

		<?php include_once( get_template_directory() . '/inc/admin/views/admin-tabs.php' ); ?>
	 
		<div class="yhsshu-row">
			<div class="yhsshu-col yhsshu-col-4">
				<div class="yhsshu-dsb-box-wrap yhsshu-dsb-box featured-box">
					<h4 class="yhsshu-dsb-title-heading"><?php esc_html_e( 'Unlock Premium Features', 'yhsshu' ); ?></h4>
					<?php include_once( get_template_directory() . '/inc/admin/views/admin-featured.php' ); ?>
				</div>
			</div>    
		 	<div class="yhsshu-col yhsshu-col-4">
		 		<div class="yhsshu-dsb-box-wrap yhsshu-dsb-box activation-box">
			 		<h4 class="yhsshu-dsb-title-heading"><?php esc_html_e( 'Theme Activation', 'yhsshu' ); ?></h4>
					<?php include_once( get_template_directory() . '/inc/admin/views/admin-registration.php' ); ?>
				</div>
			</div>	
			<div class="yhsshu-col yhsshu-col-4">
				<div class="yhsshu-dsb-box-wrap yhsshu-dsb-box system-info-box">
					<h4 class="yhsshu-dsb-title-heading"><?php esc_html_e( 'System status', 'yhsshu' ); ?></h4>
					<?php include_once( get_template_directory() . '/inc/admin/views/admin-system-info.php' ); ?>
				</div>
			</div> 
	 		 
		</div> 
 
	</div> 

</main>
