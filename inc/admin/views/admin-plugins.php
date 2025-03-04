<?php

$installed_plugins = get_plugins();
$plugins = TGM_Plugin_Activation::$instance->plugins;
$status_ins = false;
$status_act = false;
$btn_text = esc_html__('Install All', 'yhsshu');
foreach( $plugins as $plugin ){
	$file_path = $plugin['file_path'];
	if( !isset( $installed_plugins[ $file_path ] ) ) {
		$status_ins = true;
		break;
	}
}
foreach( $plugins as $plugin ){
	$file_path = $plugin['file_path'];
	if ( is_plugin_inactive( $file_path ) ) {
		$status_act = true;
		break;
	}
}

$merlin_setup = get_option( 'merlin_' . yhsshu()->get_slug() . '_completed' );
 
if( $status_ins && $status_act)
	$btn_text = esc_html__('Install & Active All', 'yhsshu');
else if($status_ins && !$status_act)
	$btn_text = esc_html__('Install All', 'yhsshu');
else if(!$status_ins && $status_act)
	$btn_text = esc_html__('Active All', 'yhsshu');
?>
<main>

	<div class="yhsshu-dashboard-wrap">

		<?php include_once( get_template_directory() . '/inc/admin/views/admin-tabs.php' ); ?>

		<?php 
		 
		$dev_mode = apply_filters( 'yhsshu_set_dev_mode', (defined('DEV_MODE') && DEV_MODE)) ;
		 
		if ( 'valid' != get_option( yhsshu()->get_slug().'_purchase_code_status', false ) && !$dev_mode ) :
			
			echo '<div class="error"><p>' .
					sprintf( wp_kses_post( esc_html__( 'The %s theme needs to be registered. %sRegister Now%s', 'yhsshu' ) ), yhsshu()->get_name(), '<a href="' . admin_url( 'admin.php?page=yhsshu') . '">' , '</a>' ) . '</p></div>';
			
		else: ?>
	
		<header class="yhsshu-dsb-header admin-plugin">
			<div class="yhsshu-dsb-header-inner">
				<h4><?php esc_html_e( 'Install Plugins', 'yhsshu' ); ?></h4>
				<?php if(!$merlin_setup && ($status_ins || $status_act)): 
					echo '<span class="yhsshu-install-all-plugin">'.$btn_text.'</span>';
					?>
				<?php endif; ?>
				
			</div> 
			<p><?php esc_html_e( 'Make sure to activate required plugins prior to import a demo.', 'yhsshu' ); ?></p>
		</header>
		  
		<div class="yhsshu-solid-wrap">
			<div class="yhsshu-row">
	        <?php
		
				foreach( $plugins as $plugin ) :
					$class = $status = $display_status = '';
					$file_path = $plugin['file_path'];
	
					// Install
					if( !isset( $installed_plugins[ $file_path ] ) ) {
						$status = 'not-installed';
					}
					// No Active
					elseif ( is_plugin_inactive( $file_path ) ) {
						$status = 'installed';
					}
					// Deactive
					elseif( !is_plugin_inactive( $file_path ) ) {
						$status = 'active';
						$class = ' yhsshu-dsb-plugin-active';
						$display_status = esc_html__( 'Active:', 'yhsshu' );
					}
			?>
				<div class="yhsshu-col yhsshu-col-3">
					<div class="yhsshu-dsb-plugin<?php echo esc_attr( $class ); ?>" data-slug="<?php echo esc_attr($plugin['slug']) ?>">
					<span class="yhsshu-dsb-plugin-icon">
						<img src="<?php echo esc_url( $plugin['logo'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ) ?>">
					</span>
					<h3><?php printf( '<span>%s</span>', $display_status ); ?> <?php echo esc_html( $plugin['name'] ) ?></h3>
					<p><?php echo esc_html( $plugin['description'] ) ?></p>
					
					<?php 
					$barplugin = new yhsshu_Admin_Plugins;
					$barplugin->tgmpa_plugin_action( $plugin, $status ); 
					?>
				</div> 
				</div> 

			<?php endforeach; ?>

			</div> 
		</div> 
		<?php endif; ?>
	</div> 

</main>