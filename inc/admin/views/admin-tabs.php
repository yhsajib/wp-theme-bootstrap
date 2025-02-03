<?php 
	$dashboard_page_url = admin_url( 'admin.php?page=yhsshu' );
	if( isset( $_GET['page'] ) && 'yhsshu' === sanitize_text_field($_GET['page']) ) {
		$dashboard_page_url = '';
	}
	$plugin_page_url = admin_url( 'admin.php?page=yhsshu-plugins' );
	$import_demos_page_url = admin_url( 'admin.php?page=yhsshu-import-demos' );

	$yhsshu_server_info = apply_filters( 'yhsshu_server_info', 
		[
			'video_url' => '',
			'demo_url' => '',
			'docs_url' => '',
			'support_url' => '']
		) ; 
?>
<nav class="yhsshu-dsb-menubar">
	<?php 
	$favicon = yhsshu()->get_theme_opt( 'favicon' );
	$logo_url = !empty($favicon['url']) ? $favicon['url'] : get_template_directory_uri() . '/inc/admin/assets/img/logo.png'; ?>
	<div class="yhsshu-dsb-logo">
		<div class="yhsshu-dsb-logo-inner">
			<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( yhsshu()->get_name() ); ?>">
		</div>
		<div class="yhsshu-dsb-logo-title">
			<h2><?php esc_html_e( 'Welcome to', 'yhsshu' ); ?> <?php echo esc_attr( yhsshu()->get_name() ).'!'; ?></h2>
			<span class="yhsshu-v"><?php esc_html_e( 'Version', 'yhsshu' ); ?> <?php echo esc_html(yhsshu()->get_version()) ?></span>
		</div>
	</div>
	<div class="yhsshu-dsb-menu">
		<ul class="yhsshu-dsb-menu-left">
			<li class="<?php echo ( isset( $_GET['page'] ) && 'yhsshu' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_attr($dashboard_page_url); ?>">
					<span><?php echo sprintf( esc_html__( '%s Dashboard', 'yhsshu' ), yhsshu()->get_name()); ?></span>
				</a>
			</li>
			<li class="<?php echo ( isset( $_GET['page'] ) && 'yhsshu-plugins' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_url($plugin_page_url); ?>">
					<span><?php esc_html_e( 'Install Plugins', 'yhsshu' ); ?></span>
				</a>
			</li>
			<li class="<?php echo ( isset( $_GET['page'] ) && 'yhsshu-import-demos' === sanitize_text_field($_GET['page']) ) ? 'is-active' : ''; ?>">
				<a href="<?php echo esc_url($import_demos_page_url); ?>">
					<span><?php esc_html_e( 'Import Demo', 'yhsshu' ); ?></span>
				</a>
			</li>
		</ul>
		<ul class="yhsshu-dsb-menu-right">
			<li>
				<a href="<?php echo esc_url($yhsshu_server_info['video_url']) ?>" target="_blank">
					<span><?php esc_html_e( 'Videos tutorial', 'yhsshu' ); ?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url($yhsshu_server_info['support_url']) ?>" target="_blank">
					<span><?php esc_html_e( 'Support system', 'yhsshu' ); ?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url($yhsshu_server_info['demo_url']) ?>" target="_blank">
					<span><?php esc_html_e( 'Live Demo', 'yhsshu' ); ?></span>
				</a>
			</li>
			 
			<li>
				<a href="<?php echo esc_url($yhsshu_server_info['docs_url']) ?>" target="_blank">
					<i class="yhsshu-icn-ess icon-md-help-circle"></i>
					<span><?php esc_html_e( 'Documentations', 'yhsshu' ); ?></span>
				</a>
			</li>
		</ul>
	</div>
</nav> 
