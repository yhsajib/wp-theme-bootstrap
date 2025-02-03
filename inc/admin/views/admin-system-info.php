<?php 
	function yhsshu_convert_to_byte ($size){
	    $label   = substr( $size, -1 );
	    $num = substr( $size, 0, -1 );
	    switch ( strtoupper( $label ) ) {
	        case 'P':
	            $num *= 1024;
	        case 'T':
	            $num *= 1024;
	        case 'G':
	            $num *= 1024;
	        case 'M':
	            $num *= 1024;
	        case 'K':
	            $num *= 1024;
	    }
	    return $num;
	}
	function yhsshu_get_system_info() {
	    $system_info = array();

	    //Upload max size
	    
	    $upload_max_size = ini_get('upload_max_filesize');
	    $upload_max_size_to_byte = yhsshu_convert_to_byte( $upload_max_size );
	    
	    array_push(
	        $system_info,
	        [
	            'title' => esc_attr__( 'Upload max file size (64MB)', 'yhsshu' ),
	            'status' => $upload_max_size_to_byte > 67108864
	        ]
	    );

	    //Limit memory
	    
	    $memory_limit = ini_get( 'memory_limit' );
	    $memory_limit_to_byte = yhsshu_convert_to_byte( $memory_limit );

	    array_push(
	        $system_info,
	        [
	            'title' => esc_attr__( 'Memory limit (256MB)', 'yhsshu' ),
	            'status' => $memory_limit_to_byte >= 268435456,
	        ]
	    );

	    //Post maxsize
	    
	    $post_maxsite = ini_get( 'post_max_size' );
	    $post_maxsite_to_byte = yhsshu_convert_to_byte( $post_maxsite );

	    array_push(
	        $system_info,
	        [
	            'title' => esc_attr__( 'Post max size (64MB)', 'yhsshu' ),
	            'status' => $post_maxsite_to_byte >= 67108864,
	        ]
	    );

	    //Max execution time
	    array_push(
	        $system_info,
	        [
	            'title' => esc_attr__( 'Max Execution Time (6s)', 'yhsshu' ),
	            'status' => ini_get( 'max_execution_time' ) >= 360,
	        ]
	    );

	    //Max input vars
	    array_push(
	        $system_info,
	        [
	            'title' => esc_attr__( 'Max input vars (3000)', 'yhsshu' ),
	            'status' => ini_get( 'max_input_vars' ) >= 3000,
	        ]
	    );
  
	    return $system_info;
	}

	$system_status = yhsshu_get_system_info();
	foreach ( $system_status as $item) :
	?>
		<div class="yhsshu-iconbox">
			<div class="yhsshu-icon-container">
				<?php if ( $item['status'] ) : ?>
					<img src="<?php echo esc_url(get_template_directory_uri()) . '/inc/admin/assets/img/check.png' ?>" alt="<?php esc_attr_e( 'Check', 'yhsshu' ); ?>">
				<?php else : ?>
					<img src="<?php echo esc_url(get_template_directory_uri()) . '/inc/admin/assets/img/crossed.png' ?>" alt="<?php esc_attr_e( 'Un Check', 'yhsshu' ); ?>">
				<?php endif; ?>
			</div>
			<div class="yhsshu-iconbox-contents">
				<span class="status-item-title">
					<?php echo esc_html( $item['title'] ); ?>
				</span>
			</div>
		</div>
	<?php endforeach; ?>