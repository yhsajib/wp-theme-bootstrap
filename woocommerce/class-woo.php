<?php
use Automattic\WooCommerce\Internal\ProductAttributesLookup\Filterer;
if (!class_exists('yhsshu_Woo')) {
    class yhsshu_Woo
    {
    	public static $product_loop_img_size = [];
    	public function get_single_product_images($product,$args){
    		$args = wp_parse_args( $args, [
    			'product_layout' => 'layout-df',
			] );
			extract($args);
			$gal_ids = $product->get_gallery_image_ids();
			$gallery_ids = [];
			$product_image_id = $product->get_image_id();
			if ( $product_image_id)
				$gallery_ids = [$product_image_id];

			if ( !empty( $gal_ids ) ){
				$gallery_ids = array_merge($gallery_ids, $gal_ids);
			}

			$image_width = intval( get_option( 'woocommerce_single_image_width', 670 ) );
			$wrap_cls = ['single-images-inner relative'];

			$product_feature_video = yhsshu()->get_page_opt('product_feature_video', 'no');
			$video_light_gallery   = isset($_GET['video-lightbox']) ? sanitize_text_field( wp_unslash($_GET['video-lightbox'])) : yhsshu()->get_page_opt('video_light_gallery', 'off');  
			$video_output = '';
			if( $product_feature_video != 'no'){
				global $wp_embed;
				$video_url             = yhsshu()->get_page_opt('video_url', '');
				$video_file            = yhsshu()->get_page_opt('video_file', []);  
				$video_html            = yhsshu()->get_page_opt('video_html', '');  

				switch ($product_feature_video) { 
					case 'video-url':
						$video_output = wp_oembed_get($video_url);
						break;
					case 'video-file':
						$video_output = do_shortcode($wp_embed->autoembed($video_file['url']));
						break;
					case 'video-html':
						$video_output = do_shortcode($wp_embed->autoembed($video_html));
						break;
					 
				}
				
			}
 
    		?>
    		<?php if( $product_layout == 'layout-df'): 
    			$image_size = ! empty( $image_size ) ? $image_size : $image_width.'x820';
    			if ( !empty( $gal_ids ) ){
    				$wrap_cls[] = 'yhsshu-product-swiper-slider yhsshu-swiper-slider has-thumbs-gallery thumbs-vertical-slider';
    			}

    			$zoom_img_hover = yhsshu()->get_theme_opt('zoom_img_hover', 'on');
    			$wrap_cls[] = !empty($video_output) ? 'video-feature' : '';
    			?>
	    		
    			<div class="<?php echo esc_attr( trim(implode(' ', $wrap_cls) )) ?>">
	    			<div class="product-main-img yhsshu-light-gallery">
	    				<div class="product-main-img-inner relative">
							<?php 
							if ( !empty( $gal_ids ) ){
								$opts = [
								    'slide_direction'               => 'horizontal',
								    'slide_percolumn'               => '1', 
								    'slide_mode'                    => 'slide', 
								    'slides_to_show_xxl'            => '1', 
								    'slides_to_show'                => '1', 
								    'slides_to_show_lg'             => '1', 
								    'slides_to_show_md'             => '1', 
								    'slides_to_show_sm'             => '1', 
								    'slides_to_show_xs'             => '1', 
								    'slides_to_scroll'              => '1', 
								    'slides_gutter'                 => 0, 
								    'arrow'                         => true,
								    'dots'                          => false,
								    'loop'                          => 'false',
								    'speed'                         => 500,
								];
								$data_settings = wp_json_encode($opts);
								$dir           = is_rtl() ? 'rtl' : 'ltr';
								?>
								<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner overflow-hidden">
						            <div class="yhsshu-swiper-container" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
						                <div class="yhsshu-swiper-wrapper swiper-wrapper">
						                	<?php 
						                	$k =  0;
						                	foreach ($gallery_ids as $ga_id) : 
						                		$k++;
						                		$attachment_info = yhsshu_Image::get_attachment_info( $ga_id );
						                		if ( empty( $attachment_info ) || ! $attachment_info['src'] ) {
													continue;
												}
						                		$data_src = $attachment_info['src'];
						                		$sub_html = '';

												if ( ! empty( $attachment_info['title'] ) ) {
													$sub_html .= "<h4>{$attachment_info['title']}</h4>";
												}

												if ( ! empty( $attachment_info['caption'] ) ) {
													$sub_html .= "<p>{$attachment_info['caption']}</p>";
												}

												if($k == 1){
													$item_cls = 'product-main-img-item';
													if( empty($video_output) || $video_light_gallery == 'off' ) 
														$item_cls .= ' zoom';
												}else{
													$item_cls = 'zoom';
												}
												 
						                		?>
						                		
												<div class="yhsshu-swiper-slide swiper-slide <?php echo esc_attr($item_cls) ?>" data-src="<?php echo esc_url($data_src) ?>" data-image-id="<?php echo esc_attr($ga_id) ?>" data-sub-html="<?php echo esc_attr( $sub_html ) ?>">
													<?php if(!empty( $video_output) && $video_light_gallery == 'off' && $k == 1 ): ?>
														<?php echo ''.$video_output; ?>
													<?php else: ?>
														<?php if($zoom_img_hover == 'on'): ?>
														<div class="zoom-hover" style="--zoom-bg-img:url('<?php echo esc_url($data_src) ?>');">
														<?php endif; ?>
														<?php 

														yhsshu_Image::yhsshu_image_by_size( array(
															'attach_id'  => $ga_id,
															'thumb_size' => $image_size,
															'class'      => 'main-img-item',
															'alt'        => $product->get_name(),
															'data-src'   => true,
															'echo'       => 'image', //image, url
														) );
													 	?>
													 	<?php if(!empty( $video_output) && $k == 1 && $video_light_gallery == 'on'):?>
													 		<?php echo '<span class="yhsshu-item-video zoom" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
													 	<?php endif; ?> 
													 	<?php if($zoom_img_hover == 'on'): ?>
													 	</div>
													 	<?php endif; ?> 
												 	<?php endif; ?> 
											 	</div>
											<?php endforeach; ?>
						                </div>
						            </div>
						        </div>
						        <div class="yhsshu-swiper-arrows nav-in-vertical arrow-on-hover">
					                <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev"><span class="yhsshu-icon lnil lnil-chevron-left"></span></div>
            						<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next"><span class="yhsshu-icon lnil lnil-chevron-right"></span></div>
					            </div>
								<?php 
							}else{
								yhsshu_print_html($this->get_product_image( $product, $image_size ));
							}
							?>
							<?php if( empty( $video_output) ): ?>
								<div class="yhsshu-cursor-icon"><span class="yhsshu-icon lnil lnil-plus"></span></div> 
							<?php endif; ?>
						</div>
					</div>
					<?php if ( ! empty( $gal_ids ) ) : 
						$thumb_opts = [
						    'slide_direction'               => 'vertical',
						    'slide_direction_mobile'        => 'horizontal',
						    'slide_percolumn'               => '1', 
						    'slide_mode'                    => 'slide', 
						    'slides_to_show_xxl'            => 'auto', 
						    'slides_to_show'                => 'auto', 
						    'slides_to_show_lg'             => 'auto', 
						    'slides_to_show_md'             => '3', 
						    'slides_to_show_sm'             => '6', 
						    'slides_to_show_xs'             => '4', 
						    'slides_to_scroll'              => 1, 
						    'slides_gutter'                 => 10, 
						    'arrow'                         => 'false',
						    'dots'                          => false,
						    'loop'                          => 'false',
						    'speed'                         => 500,
						];
						$data_thumb_settings = wp_json_encode($thumb_opts);
						$dir           = is_rtl() ? 'rtl' : 'ltr';
						?>
						<div class="product-gallery-img "> 
							<div class="product-gallery-carousel yhsshu-swiper-slider">
								<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner overflow-hidden">
									<div class="swiper-container-thumbs yhsshu-swiper-thumbs" data-settings="<?php echo esc_attr($data_thumb_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
				                		<div class="yhsshu-swiper-wrapper swiper-wrapper">
											<?php foreach ($gallery_ids as $ga_id) : ?>
												<div class="yhsshu-swiper-slide swiper-slide" data-image-id="<?php echo esc_attr($ga_id) ?>">
													<div class="thumbs-img relative">
														<span class="draw-top-right"></span>
														<span class="draw-bottom-left"></span>
													<?php 
													yhsshu_Image::yhsshu_image_by_size( array(
														'attach_id'  => $ga_id,
														'thumb_size' => '270x330',
														'class'      => 'p-img-hover-gal',
														'alt'        => $product->get_name(),
														'data-src'   => true,
														'echo'       => 'image', //image, url
													) );
												 	?>
												 	<?php if(!empty( $video_output) && $k == 1):?>
												 		<?php echo '<span class="yhsshu-item-video" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
												 	<?php endif; ?> 
												 	</div>
											 	</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="yhsshu-swiper-arrows">
					                <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev"><span class="yhsshu-icon lnil lnil-chevron-left"></span></div>
            						<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next"><span class="yhsshu-icon lnil lnil-chevron-right"></span></div>
					            </div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if( $product_layout == 'layout-sticky'):
			 	$image_size = ! empty( $image_size ) ? $image_size : $image_width.'x820';
			 	if ( !empty( $gal_ids ) ){
    				$wrap_cls[] = 'yhsshu-product-sticky has-thumbs-gallery thumbs-vertical-left';
    				/*if ( $product_image_id = $product->get_image_id() ) { 
    					$gallery_ids = array_merge([$product_image_id], $gallery_ids) ;
    				}*/
    			}
    			$zoom_img_hover = yhsshu()->get_theme_opt('zoom_img_hover', 'on');
    			$gal_display_type = isset($_GET['img-display-type']) ? sanitize_text_field( wp_unslash($_GET['img-display-type'])) : yhsshu()->get_opt('product_grid_gal_display_type','all');
    			$display_type_cls = $gal_display_type == 'by-attribute' ? 'display-by-attribute' : 'display-all';
    			$wrap_cls[] = $display_type_cls;
    			$wrap_cls[] = !empty($video_output) ? 'video-feature' : '';

			 	?>
			 	<div class="<?php echo esc_attr( trim(implode(' ', $wrap_cls) )) ?>">
			 		<?php if ( ! empty( $gal_ids ) ) : 
						?>
						<div class="product-gallery-img"> 
							<div class="product-gallery-inner d-flex flex-column">
								<?php 
								$k = 0;
								foreach ($gallery_ids as $ga_id) : 
									$k++;
									?>
									<div class="thumbs-item" data-image-id="<?php echo esc_attr($ga_id) ?>">
										<div class="thumbs-img relative">
											<span class="draw-top-right"></span>
											<span class="draw-bottom-left"></span>
											<?php 
											yhsshu_Image::yhsshu_image_by_size( array(
												'attach_id'  => $ga_id,
												'thumb_size' => '270x330',
												'class'      => 'p-img-hover-gal',
												'alt'        => $product->get_name(),
												'data-src'   => true,
												'echo'       => 'image', //image, url
											) );
										 	?>
										 	<?php if(!empty( $video_output) && $k == 1):?>
										 		<?php echo '<span class="yhsshu-item-video" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
										 	<?php endif; ?> 
									 	</div>
								 	</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
			 		<div class="product-main-img yhsshu-light-gallery">
	    				<div class="product-main-img-inner relative">
							<?php 
							if ( !empty( $gal_ids ) ){
								?>	
				                <div class="yhsshu-img-sticky-wrapper d-flex flex-column">
				                	<?php 
				                	$k =  0;
				                	foreach ($gallery_ids as $ga_id) : 
				                		$k++;
				                		$attachment_info = yhsshu_Image::get_attachment_info( $ga_id );
				                		if ( empty( $attachment_info ) || ! $attachment_info['src'] ) {
											continue;
										}
				                		$data_src = $attachment_info['src'];
				                		$sub_html = '';

										if ( ! empty( $attachment_info['title'] ) ) {
											$sub_html .= "<h4>{$attachment_info['title']}</h4>";
										}

										if ( ! empty( $attachment_info['caption'] ) ) {
											$sub_html .= "<p>{$attachment_info['caption']}</p>";
										}
										
										if($k == 1){
											$item_cls = 'product-main-img-item';
											if( empty($video_output) || $video_light_gallery == 'off' ) 
												$item_cls .= ' zoom';
										}else{
											$item_cls = 'zoom';
										}
				                		?>
										<div class="image-item  <?php echo esc_attr($item_cls) ?>" data-src="<?php echo esc_url($data_src) ?>" data-image-id="<?php echo esc_attr($ga_id) ?>" data-sub-html="<?php echo esc_attr( $sub_html ) ?>">
											<?php if(!empty( $video_output) && $video_light_gallery == 'off' && $k == 1 ): ?>
												<?php echo ''.$video_output; ?>
											<?php else: ?>
												<?php if($zoom_img_hover == 'on'): ?>
													<div class="zoom-hover" style="--zoom-bg-img:url('<?php echo esc_url($data_src) ?>');">
												<?php endif; ?>
												<?php 
													yhsshu_Image::yhsshu_image_by_size( array(
														'attach_id'  => $ga_id,
														'thumb_size' => $image_size,
														'class'      => 'main-img-item main-img-sticky',
														'alt'        => $product->get_name(),
														'data-src'   => true,
														'echo'       => 'image', //image, url
													) );
											 	?>
											 	<?php if(!empty( $video_output) && $k == 1 && $video_light_gallery == 'on'):?>
											 		<?php echo '<span class="yhsshu-item-video zoom" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
											 	<?php endif; ?> 	
											 	<?php if($zoom_img_hover == 'on'): ?>
											 		</div>
										 		<?php endif; ?> 
									 		<?php endif; ?> 
									 	</div>
									<?php endforeach; ?>
				                </div>
								<?php 
							}else{
								yhsshu_print_html($this->get_product_image( $product, $image_size )); 
							}
							?>
							<?php wc_get_template( 'single-product/yhsshu-sale-flash.php');?>
							<?php if( empty( $video_output) ): ?>
								<div class="yhsshu-cursor-icon"><span class="yhsshu-icon lnil lnil-plus"></span></div> 
							<?php endif; ?>
						</div>
					</div>
			 	</div>
			<?php endif; ?>

			<?php if( $product_layout == 'layout-with-sidebar'):
				$image_size = ! empty( $image_size ) ? $image_size : $image_width.'x820';
    			if ( !empty( $gal_ids ) ){
    				$wrap_cls[] = 'yhsshu-product-swiper-slider yhsshu-swiper-slider has-thumbs-gallery thumbs-horizontal-slider';
    				/*if ( $product_image_id = $product->get_image_id() ) { 
    					$gallery_ids = array_merge([$product_image_id], $gallery_ids) ;
    				}*/
    			}
    			$zoom_img_hover = yhsshu()->get_theme_opt('zoom_img_hover', 'on');
    			$wrap_cls[] = !empty($video_output) ? 'video-feature' : '';
    			?>
    			<div class="<?php echo esc_attr( trim(implode(' ', $wrap_cls) )) ?>">
	    			<div class="product-main-img yhsshu-light-gallery">
	    				<div class="product-main-img-inner relative">
							<?php 
							if ( !empty( $gal_ids ) ){
								$opts = [
								    'slide_direction'               => 'horizontal',
								    'slide_percolumn'               => '1', 
								    'slide_mode'                    => 'slide', 
								    'slides_to_show_xxl'            => '1', 
								    'slides_to_show'                => '1', 
								    'slides_to_show_lg'             => '1', 
								    'slides_to_show_md'             => '1', 
								    'slides_to_show_sm'             => '1', 
								    'slides_to_show_xs'             => '1', 
								    'slides_to_scroll'              => '1', 
								    'slides_gutter'                 => 0, 
								    'arrow'                         => true,
								    'dots'                          => false,
								    'loop'                          => 'false',
								    'speed'                         => 500,
								];
								$data_settings = wp_json_encode($opts);
								$dir           = is_rtl() ? 'rtl' : 'ltr';
								?>
								<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner overflow-hidden">
						            <div class="yhsshu-swiper-container" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
						                <div class="yhsshu-swiper-wrapper swiper-wrapper">
						                	<?php 
						                	$k =  0;
						                	foreach ($gallery_ids as $ga_id) : 
						                		$k++;
						                		$attachment_info = yhsshu_Image::get_attachment_info( $ga_id );
						                		if ( empty( $attachment_info ) || ! $attachment_info['src'] ) {
													continue;
												}
						                		$data_src = $attachment_info['src'];
						                		$sub_html = '';

												if ( ! empty( $attachment_info['title'] ) ) {
													$sub_html .= "<h4>{$attachment_info['title']}</h4>";
												}

												if ( ! empty( $attachment_info['caption'] ) ) {
													$sub_html .= "<p>{$attachment_info['caption']}</p>";
												}
												if($k == 1){
													$item_cls = 'product-main-img-item';
													if( empty($video_output) || $video_light_gallery == 'off' ) 
														$item_cls .= ' zoom';
												}else{
													$item_cls = 'zoom';
												}
						                		?>
						                		
												<div class="yhsshu-swiper-slide swiper-slide zoom <?php echo esc_attr($item_cls) ?>" data-src="<?php echo esc_url($data_src) ?>" data-image-id="<?php echo esc_attr($ga_id) ?>" data-sub-html="<?php echo esc_attr( $sub_html ) ?>">
													<?php if(!empty( $video_output) && $video_light_gallery == 'off' && $k == 1 ): ?>
														<?php echo ''.$video_output; ?>
													<?php else: ?>
														<?php if($zoom_img_hover == 'on'): ?>
														<div class="zoom-hover" style="--zoom-bg-img:url('<?php echo esc_url($data_src) ?>');">
														<?php endif; ?>
														<?php 

														yhsshu_Image::yhsshu_image_by_size( array(
															'attach_id'  => $ga_id,
															'thumb_size' => $image_size,
															'class'      => 'main-img-item',
															'alt'        => $product->get_name(),
															'data-src'   => true,
															'echo'       => 'image', //image, url
														) );
													 	?>
													 	<?php if(!empty( $video_output) && $k == 1 && $video_light_gallery == 'on'):?>
													 		<?php echo '<span class="yhsshu-item-video zoom" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
													 	<?php endif; ?> 
													 	<?php if($zoom_img_hover == 'on'): ?>
													 	</div>
													 	<?php endif; ?> 
												 	<?php endif; ?> 
											 	</div>
											<?php endforeach; ?>
						                </div>
						            </div>
						        </div>
						        <div class="yhsshu-swiper-arrows nav-in-vertical arrow-on-hover">
					                <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev"><span class="yhsshu-icon lnil lnil-chevron-left"></span></div>
            						<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next"><span class="yhsshu-icon lnil lnil-chevron-right"></span></div>
					            </div>
								<?php 
							}else{
								yhsshu_print_html($this->get_product_image( $product, $image_size )); 
							}
							?>
							<?php wc_get_template( 'single-product/yhsshu-sale-flash.php');?>
							<?php if( empty( $video_output) ): ?>
								<div class="yhsshu-cursor-icon"><span class="yhsshu-icon lnil lnil-plus"></span></div> 
							<?php endif; ?>
						</div>
					</div>
					<?php if ( !empty( $gal_ids ) ): 
						$thumb_opts = [
						    'slide_direction'               => 'horizontal',
						    //'slide_direction_mobile'        => 'horizontal',
						    'slide_percolumn'               => '1', 
						    'slide_mode'                    => 'slide', 
						    'slides_to_show_xxl'            => '4', 
						    'slides_to_show'                => '4', 
						    'slides_to_show_lg'             => '4', 
						    'slides_to_show_md'             => '3', 
						    'slides_to_show_sm'             => '6', 
						    'slides_to_show_xs'             => '4', 
						    'slides_to_scroll'              => 1, 
						    'slides_gutter'                 => 10, 
						    'arrow'                         => 'false',
						    'dots'                          => false,
						    'loop'                          => 'false',
						    'speed'                         => 500,
						];
						$data_thumb_settings = wp_json_encode($thumb_opts);
						$dir           = is_rtl() ? 'rtl' : 'ltr';
						?>
						<div class="product-gallery-img"> 
							<div class="product-gallery-carousel yhsshu-swiper-slider relative">
								<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner overflow-hidden">
									<div class="swiper-container-thumbs yhsshu-swiper-thumbs" data-settings="<?php echo esc_attr($data_thumb_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
				                		<div class="yhsshu-swiper-wrapper swiper-wrapper">
											<?php foreach ($gallery_ids as $ga_id) : ?>
												<div class="yhsshu-swiper-slide swiper-slide" data-image-id="<?php echo esc_attr($ga_id) ?>">
													<div class="thumbs-img relative">
														<span class="draw-top-right"></span>
														<span class="draw-bottom-left"></span>
													<?php 
													yhsshu_Image::yhsshu_image_by_size( array(
														'attach_id'  => $ga_id,
														'thumb_size' => '270x330',
														'class'      => 'p-img-hover-gal',
														'alt'        => $product->get_name(),
														'data-src'   => true,
														'echo'       => 'image', //image, url
													) );
												 	?>
												 	</div>
											 	</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="yhsshu-swiper-arrows nav-in-vertical">
					                <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev"><span class="yhsshu-icon lnil lnil-chevron-left"></span></div>
            						<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next"><span class="yhsshu-icon lnil lnil-chevron-right"></span></div>
					            </div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php if( $product_layout == 'layout-full-width'):
			 	$image_size = ! empty( $image_size ) ? $image_size : $image_width.'x820';
			 	if ( !empty( $gal_ids ) ){
    				$wrap_cls[] = 'yhsshu-product-list-gallery';
    			}
    			$zoom_img_hover = yhsshu()->get_theme_opt('zoom_img_hover', 'on');
    			$gal_display_type = isset($_GET['img-display-type']) ? sanitize_text_field( wp_unslash($_GET['img-display-type'])) : yhsshu()->get_opt('product_grid_gal_display_type','all');
    			$display_type_cls = $gal_display_type == 'by-attribute' ? 'display-by-attribute' : 'display-all';
    			$wrap_cls[] = $display_type_cls;
    			$wrap_cls[] = !empty($video_output) ? 'video-feature' : '';
			 	?>
			 	<div class="<?php echo esc_attr( trim(implode(' ', $wrap_cls) )) ?>">
			 		<div class="product-main-img yhsshu-light-gallery">
	    				<div class="product-main-img-inner relative">
							<?php 
							if ( !empty( $gal_ids ) ){
								?>	
				                <div class="yhsshu-img-list-wrapper d-flex flex-column">
				                	<?php 
				                	$k =  0;
				                	foreach ($gallery_ids as $ga_id) : 
				                		$k++;
				                		$attachment_info = yhsshu_Image::get_attachment_info( $ga_id );
				                		if ( empty( $attachment_info ) || ! $attachment_info['src'] ) {
											continue;
										}
				                		$data_src = $attachment_info['src'];
				                		$sub_html = '';

										if ( ! empty( $attachment_info['title'] ) ) {
											$sub_html .= "<h4>{$attachment_info['title']}</h4>";
										}

										if ( ! empty( $attachment_info['caption'] ) ) {
											$sub_html .= "<p>{$attachment_info['caption']}</p>";
										}
										if($k == 1){
											$item_cls = 'product-main-img-item';
											if( empty($video_output) || $video_light_gallery == 'off' ) 
												$item_cls .= ' zoom';
										}else{
											$item_cls = 'zoom';
										}
				                		?>
										<div class="image-item zoom <?php echo esc_attr($item_cls) ?>" data-src="<?php echo esc_url($data_src) ?>" data-image-id="<?php echo esc_attr($ga_id) ?>" data-sub-html="<?php echo esc_attr( $sub_html ) ?>">
											<?php if(!empty( $video_output) && $video_light_gallery == 'off' && $k == 1 ): ?>
												<?php echo ''.$video_output; ?>
											<?php else: ?>
												<?php if($zoom_img_hover == 'on'): ?>
												<div class="zoom-hover" style="--zoom-bg-img:url('<?php echo esc_url($data_src) ?>');">
												<?php endif; ?>
												<?php 
												yhsshu_Image::yhsshu_image_by_size( array(
													'attach_id'  => $ga_id,
													'thumb_size' => $image_size,
													'class'      => 'main-img-item',
													'alt'        => $product->get_name(),
													'data-src'   => true,
													'echo'       => 'image', //image, url
												) );
											 	?>
											 	<?php if(!empty( $video_output) && $k == 1 && $video_light_gallery == 'on'):?>
											 		<?php echo '<span class="yhsshu-item-video zoom" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
											 	<?php endif; ?> 
											 	<?php if($zoom_img_hover == 'on'): ?>
											 	</div>
											 	<?php endif; ?> 
										 	<?php endif; ?> 
									 	</div>
									<?php endforeach; ?>
				                </div>
								<?php 
							}else{
								yhsshu_print_html($this->get_product_image( $product, $image_size ));
							}
							?>
							<?php wc_get_template( 'single-product/yhsshu-sale-flash.php');?>
							<?php if( empty( $video_output) ): ?>
								<div class="yhsshu-cursor-icon"><span class="yhsshu-icon lnil lnil-plus"></span></div> 
							<?php endif; ?>
						</div>
					</div>
			 	</div>
			<?php endif; ?>

			<?php if( $product_layout == 'layout-grid-gallery'):
			 	$image_size = ! empty( $image_size ) ? $image_size : $image_width.'x820';
			 	if ( !empty( $gal_ids ) ){
    				$wrap_cls[] = 'yhsshu-product-grid-gallery';
    			}
    			$zoom_img_hover = yhsshu()->get_theme_opt('zoom_img_hover', 'on');
    			$gal_display_type = isset($_GET['img-display-type']) ? sanitize_text_field( wp_unslash($_GET['img-display-type'])) : yhsshu()->get_opt('product_grid_gal_display_type','all');
    			$display_type_cls = $gal_display_type == 'by-attribute' ? 'display-by-attribute' : 'display-all';
    			$wrap_cls[] = $display_type_cls;
    			$wrap_cls[] = !empty($video_output) ? 'video-feature' : '';
			 	?>
			 	<div class="<?php echo esc_attr( trim(implode(' ', $wrap_cls) )) ?>">
			 		<div class="product-main-img yhsshu-light-gallery">
	    				<div class="product-main-img-inner relative">
							<?php 
							if ( !empty( $gal_ids ) ){
								$row_cols_class = yhsshu_get_shop_loop_row_column_class([
								    'col_xs'  => yhsshu()->get_opt('products_grid_gal_col_xs', '2'),
								    'col_sm'  => yhsshu()->get_opt('products_grid_gal_col_sm', '2'),  
								    'col_md'  => yhsshu()->get_opt('products_grid_gal_col_md', '2'), 
								    'col_lg'  => yhsshu()->get_opt('products_grid_gal_col_lg', '2'),
								    'col_xl'  => yhsshu()->get_opt('products_grid_gal_col_xl', '2'),  
								    'col_xxl' => yhsshu()->get_opt('products_grid_gal_col_xxl', '2')
								]); 
								
								$g_x_cls = yhsshu_get_grid_gutter_x_class('products_grid_gal_gutter_x', true);
								$g_y_cls = yhsshu_get_grid_gutter_y_class('products_grid_gal_gutter_y', true);
								$g_x_cls = !empty($g_x_cls) ? $g_x_cls : ['gx-15'];
								$g_y_cls = !empty($g_y_cls) ? $g_y_cls : ['gy-15'];
								?>	
				                <div class="yhsshu-img-grid-wrapper row relative <?php echo esc_attr(implode(' ', $g_x_cls)) ?> <?php echo esc_attr(implode(' ', $g_y_cls)) ?> <?php echo esc_attr(implode(' ', $row_cols_class)) ?>">
				                	<?php 
				                	$k =  0;
				                	foreach ($gallery_ids as $ga_id) : 
				                		$k++;
				                		$attachment_info = yhsshu_Image::get_attachment_info( $ga_id );
				                		if ( empty( $attachment_info ) || ! $attachment_info['src'] ) {
											continue;
										}
				                		$data_src = $attachment_info['src'];
				                		$sub_html = '';

										if ( ! empty( $attachment_info['title'] ) ) {
											$sub_html .= "<h4>{$attachment_info['title']}</h4>";
										}

										if ( ! empty( $attachment_info['caption'] ) ) {
											$sub_html .= "<p>{$attachment_info['caption']}</p>";
										}
										if($k == 1){
											$item_cls = 'product-main-img-item';
											if( empty($video_output) || $video_light_gallery == 'off' ) 
												$item_cls .= ' zoom';
										}else{
											$item_cls = 'zoom';
										}
				                		?>
										<div class="image-item zoom <?php echo esc_attr($item_cls) ?>" data-src="<?php echo esc_url($data_src) ?>" data-image-id="<?php echo esc_attr($ga_id) ?>" data-sub-html="<?php echo esc_attr( $sub_html ) ?>">
											<?php if(!empty( $video_output) && $video_light_gallery == 'off' && $k == 1 ): ?>
												<?php echo ''.$video_output; ?>
											<?php else: ?>
												<?php if($zoom_img_hover == 'on'): ?>
												<div class="zoom-hover" style="--zoom-bg-img:url('<?php echo esc_url($data_src) ?>');">
												<?php endif; ?>
												<?php 
												yhsshu_Image::yhsshu_image_by_size( array(
													'attach_id'  => $ga_id,
													'thumb_size' => $image_size,
													'class'      => 'main-img-item',
													'alt'        => $product->get_name(),
													'data-src'   => true,
													'echo'       => 'image', //image, url
												) );
											 	?>
											 	<?php if(!empty( $video_output) && $k == 1 && $video_light_gallery == 'on'):?>
											 		<?php echo '<span class="yhsshu-item-video zoom" data-src="'.esc_url($video_url).'"><span class="yhsshui-play"></span></span>'; ?>
											 	<?php endif; ?> 
											 	<?php if($zoom_img_hover == 'on'): ?>
											 	</div>
											 	<?php endif; ?> 
										 	<?php endif; ?> 
									 	</div>
									<?php endforeach; ?>
				                </div>
								<?php 
							}else{
								yhsshu_print_html($this->get_product_image( $product, $image_size )); 
							}
							?>
							<?php wc_get_template( 'single-product/yhsshu-sale-flash.php');?>
							<?php if( empty( $video_output) ): ?>
								<div class="yhsshu-cursor-icon"><span class="yhsshu-icon lnil lnil-plus"></span></div> 
							<?php endif; ?>
						</div>
					</div>
			 	</div>
			<?php endif; ?>
			
    		<?php 
    	}
    	public function get_loop_product_thumbnail($product,$args){ 

    		$has_hover_thumbnail = false;
    		$shop_archive_hover_image = isset($args['shop_archive_hover_image']) ? $args['shop_archive_hover_image'] : yhsshu()->get_theme_opt('shop_archive_hover_image', '0');
    		$thumb_class = '';
    		if($shop_archive_hover_image == '1' || $shop_archive_hover_image == '2'){
				$gallery_ids = $product->get_gallery_image_ids();
				if ( ! empty( $gallery_ids ) ) {
					$has_hover_thumbnail = true;
					$thumb_class = 'has-hover-img';
				}
				if($shop_archive_hover_image == '2'){
					wp_enqueue_script( 'swiper' );
			        wp_enqueue_script( 'yhsshu-swiper' );

			        $opts = [
			            'slide_direction'               => 'horizontal',
			            'slide_percolumn'               => '1', 
			            'slide_mode'                    => 'slide', 
			            'slides_to_show_xxl'            => 1, 
			            'slides_to_show'                => 1, 
			            'slides_to_show_lg'             => 1, 
			            'slides_to_show_md'             => 1, 
			            'slides_to_show_sm'             => 1, 
			            'slides_to_show_xs'             => 1, 
			            'slides_to_scroll'              => 1, 
			            'slides_gutter'                 => 1, 
			            'arrow'                         => true,
			            'dots'                          => false,
			            'loop'                          => 'false',
			            'speed'                          => 500,
			        ];
			        $data_settings = wp_json_encode($opts);
			        $dir           = is_rtl() ? 'rtl' : 'ltr';
				}
			}
			 
			$thumbnail_size = ! empty( $args['thumbnail_size'] ) ? $args['thumbnail_size'] : $this->get_loop_product_image_size();

    		?>
    		<div class="thumb-wrap <?php echo esc_attr($thumb_class) ?>">
				<?php woocommerce_template_loop_product_link_open(); ?>
				<div class="product-main-img">
					<?php yhsshu_print_html($this->get_product_image( $product, $thumbnail_size )); ?>
				</div>
				<?php if ( $has_hover_thumbnail ) { ?>
					<div class="product-hover-img yhsshu-absoluted">
						<?php if($shop_archive_hover_image == '1'): ?>
							<?php 
							yhsshu_Image::yhsshu_image_by_size( array(
								'attach_id'  => $gallery_ids[0],
								'thumb_size' => $thumbnail_size,
								'class'      => 'p-img-hover',
								'alt'        => $product->get_name(),
								'data-src'   => true,
								'echo'       => 'image', //image, url
							) );
						 	?>
						<?php endif; ?>
						<?php if($shop_archive_hover_image == '2'): ?>
							<div class="product-loop-carousel yhsshu-swiper-slider yhsshu-theme-carousel">
								<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner overflow-hidden">
									<div class="yhsshu-swiper-container" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
	                            		<div class="yhsshu-swiper-wrapper swiper-wrapper">
											<?php foreach ($gallery_ids as $ga_id) : ?>
												<div class="yhsshu-swiper-slide swiper-slide">
													<?php 
													yhsshu_Image::yhsshu_image_by_size( array(
														'attach_id'  => $ga_id,
														'thumb_size' => $thumbnail_size,
														'class'      => 'p-img-hover-gal',
														'alt'        => $product->get_name(),
														'data-src'   => true,
														'echo'       => 'image', //image, url
													) );
												 	?>
											 	</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="yhsshu-swiper-arrows nav-in-vertical">
						            <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev"><span class="yhsshu-icon lnil lnil-chevron-left"></span></div>
						            <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next"><span class="yhsshu-icon lnil lnil-chevron-right"></span></div>
						        </div>
							</div>
						<?php endif; ?>
					</div>
				<?php } ?>

				<?php woocommerce_template_loop_product_link_close(); ?>
			</div>
    		<?php 
    	}
    	public function get_product_image( $product, $size = 'full', $args = [] ) {
			$args = wp_parse_args( $args, [
				'class' => 'main-img-item product-main-image attachment-woocommerce_thumbnail',
			] );

			if ( $product_image_id = $product->get_image_id() ) {  
				return yhsshu_Image::yhsshu_image_by_size( array(
					'attach_id'  => $product_image_id,
					'thumb_size' => $size,
					'alt'        => $product->get_name(),
					'data-src'   => true,
					'class'      => $args['class'],
					'return'     => 'image', //image, url
					//'echo'     => 'image', //image, url
                ));
				  
			} elseif ( $product->get_parent_id() ) {
				$parent_product = wc_get_product( $product->get_parent_id() );
				if ( $parent_product && $product_parent_image_id = $parent_product->get_image_id() ) {
					return yhsshu_Image::yhsshu_image_by_size( array(
						'attach_id'  => $product_parent_image_id,
						'thumb_size' => $size,
						'alt'        => $parent_product->get_name(),
						'data-src'   => true,
						'class'      => $args['class'],
						'return'     => 'image', //image, url
	                ));
				}
			}

			$src               = WC()->plugin_url() . '/assets/images/placeholder.png';
			$placeholder_image = get_option( 'woocommerce_placeholder_image', 0 );

			if ( ! empty( $placeholder_image ) && is_numeric( $placeholder_image ) ) {
				return yhsshu_Image::yhsshu_image_by_size( array(
					'attach_id'  => $placeholder_image,
					'thumb_size' => $size,
					'alt'        => $product->get_name(),
					'data-src'   => true,
					'class'      => $args['class'],
					'return'     => 'image', //image, url
                ));
				  
			} else {
				return '<img src="' . $src . '" alt="' . esc_attr( $product->get_name() ) . '" class="main-img-item product-main-image"/>';
			}
 			
		}
		public function get_loop_product_image_size( $width = 0 ) {
			if ( 0 === $width ) {
				$width = intval( get_option( 'woocommerce_thumbnail_image_width', 460 ) );
			}

			if ( isset( self::$product_loop_img_size[ $width ] ) ) {
				return self::$product_loop_img_size[ $width ];
			}

			$image_size = $this->get_product_img_size_by_width( $width );
			self::$product_loop_img_size[ $width ] = $image_size;

			return $image_size;
		}
		  
		public function get_product_img_size_by_width( $width = 460 ) {
			$height = $this->get_product_img_height_by_width( $width );

			return $width . 'x' . $height;
		}
		public function get_product_img_height_by_width( $width = 460 ) {
			$cropping = get_option( 'woocommerce_thumbnail_cropping' );

			switch ( $cropping ) {
				case 'custom':
					$ratio_w = floatval( get_option( 'woocommerce_thumbnail_cropping_custom_width' ) );
					$ratio_h = floatval( get_option( 'woocommerce_thumbnail_cropping_custom_height' ) );

					// Normalize data to avoid division for 0.
					$ratio_h = $ratio_h > 0 ? $ratio_h : 1;
					$ratio_w = $ratio_w > 0 ? $ratio_w : $ratio_h;

					$height = ( $width * $ratio_h ) / $ratio_w;
					$height = (int) $height;

					break;
				case 'uncropped':
					$height = 9999;
					break;
				default:
					$height = $width;
					break;
			}

			return $height;
		} 
		
		public function get_the_product_brands_list( $post_id, $taxonomy, $before = '', $sep = '', $after = '' ) {
			$terms = get_the_terms( $post_id, $taxonomy );

			if ( is_wp_error( $terms ) ) {
				return $terms;
			}

			if ( empty( $terms ) ) {
				return false;
			}

			$links = array();
			$is_external = true;
			foreach ( $terms as $term ) {
				$link = get_term_meta( $term->term_id, 'url', true );

				if ( empty( $link ) ) {
					$is_external = false;
					$link = get_term_link( $term, $taxonomy );
				}
 
				if ( is_wp_error( $link ) ) {
					return $link;
				}
				if( $is_external )
					$links[] = '<a href="' . esc_url( $link ) . '" rel="tag" target="_blank">' . $term->name . '</a>';
				else
					$links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
			}
 
			$term_links = apply_filters( "term_links-{$taxonomy}", $links );  

			return $before . implode( $sep, $term_links ) . $after;
		}
		 
		public function get_brand_count($post_id, $taxonomy){
			global $product;
			$terms = get_the_terms( $post_id, $taxonomy );
			return is_wp_error( $terms ) || empty( $terms ) ? 0 : count($terms); 
		}
  
		public function get_variation_attributes_from_attributes( $attributes ) {
			return array_filter( $attributes, array(
				$this,
				'filter_variation_attributes',
			) );
		} 
		public function filter_variation_attributes( $attribute ) {
			return true === $attribute->get_variation();
		}

		public function get_shop_base_url() {
			if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
				$link = home_url();
			} elseif ( is_shop() ) {
				$link = get_permalink( wc_get_page_id( 'shop' ) );
			} elseif ( is_product_category() ) {
				$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
			} elseif ( is_product_tag() ) {
				$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
			} elseif ( is_tax() ) {
				$queried_object = get_queried_object();
				$link           = get_term_link( $queried_object->slug, $queried_object->taxonomy );
			} else {
				$link = get_permalink();
			}

			return $link;
		}

		public function get_shop_active_filters_url( $filters = array(), $link = '' ) {
			if ( empty( $link ) ) {
				$link = $this->get_shop_base_url();
			}

			if ( empty( $filters ) ) {
				$filters = $_GET;
			}

			// Min/Max.
			if ( isset( $filters['min_price'] ) ) {
				$link = add_query_arg( 'min_price', wc_clean( wp_unslash( $filters['min_price'] ) ), $link );
			}

			if ( isset( $filters['max_price'] ) ) {
				$link = add_query_arg( 'max_price', wc_clean( wp_unslash( $filters['max_price'] ) ), $link );
			}

			// Order by.
			if ( isset( $filters['orderby'] ) ) {
				$link = add_query_arg( 'orderby', wc_clean( wp_unslash( $filters['orderby'] ) ), $link );
			}

			/**
			 * Search Arg.
			 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
			 */
			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
			}

			// Post Type Arg.
			if ( isset( $filters['post_type'] ) ) {
				$link = add_query_arg( 'post_type', wc_clean( wp_unslash( $filters['post_type'] ) ), $link );

				// Prevent post type and page id when pretty permalinks are disabled.
				if ( is_shop() ) {
					$link = remove_query_arg( 'page_id', $link );
				}
			}

			// Min Rating Arg.
			if ( isset( $filters['rating_filter'] ) ) {
				$link = add_query_arg( 'rating_filter', wc_clean( wp_unslash( $filters['rating_filter'] ) ), $link );
			}

			if ( ! empty( $filters['filter_product_cat'] ) ) {
				$link = add_query_arg( 'filter_product_cat', wc_clean( wp_unslash( $filters['filter_product_cat'] ) ), $link );
			}

			if ( ! empty( $filters['filter_product_tag'] ) ) {
				$link = add_query_arg( 'filter_product_tag', wc_clean( wp_unslash( $filters['filter_product_tag'] ) ), $link );
			}

			if ( ! empty( $filters['filter_product_brand'] ) ) {
				$link = add_query_arg( 'filter_product_brand', wc_clean( wp_unslash( $filters['filter_product_brand'] ) ), $link );
			}

			// All current filters.
			 
			$chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
			if ( $chosen_attributes ) { 
				foreach ( $chosen_attributes as $name => $data ) {
					$filter_name = wc_attribute_taxonomy_slug( $name );

					if ( ! empty( $data['terms'] ) ) {
						$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
					}
					if ( 'or' === $data['query_type'] ) {
						$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
					}
				}
			}

			return $link;
		}

		public function get_active_filter_remove_links( $filters ) {
			$filter_link = $this->get_shop_active_filters_url( $filters );

			$clear_links = [];

			foreach ( $filters as $filter_name => $value ) {
				$taxonomy_name = 0 === strpos( $filter_name, 'filter_' ) ? wc_sanitize_taxonomy_name( str_replace( 'filter_', '', $filter_name ) ) : '';

				$attribute_name = wc_attribute_taxonomy_name( $taxonomy_name );
				$attribute_id   = ! empty( $attribute_name ) ? wc_attribute_taxonomy_id_by_name( $attribute_name ) : 0;

				// This is taxonomy filter as category, tag, brand...
				if ( ! empty( $taxonomy_name ) && taxonomy_exists( $taxonomy_name ) ) {
					$taxonomy = get_taxonomy( $taxonomy_name );

					$filter_terms = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

					if ( empty( $filter_terms ) ) {
						continue;
					}

					foreach ( $filter_terms as $key => $term_id ) {
						$clear_link = $filter_link;
						$clear_link = remove_query_arg( $filter_name, $clear_link );

						$term = get_term_by( 'id', $term_id, $taxonomy_name );

						if ( empty( $term ) ) {
							continue;
						}

						$clone_terms = $filter_terms;
						unset( $clone_terms[ $key ] );

						if ( empty( $clone_terms ) ) {
							$clear_link = remove_query_arg( $filter_name, $clear_link );
						} else {
							// Re add.
							$clear_link = add_query_arg( $filter_name, implode( ',', $clone_terms ), $clear_link );
						}

						$tooltip_text = isset( $taxonomy->labels->singular_name ) ? $taxonomy->labels->singular_name : __( 'Filter', 'yhsshu' );

						$clear_links[] = [
							'url'     => $clear_link,
							'text'    => $term->name,
							'tooltip' => sprintf( __( 'Remove This %s', 'yhsshu' ), $tooltip_text ),
							'class'   => 'remove-filter-link',
						];
					}
				} elseif ( $attribute_id && taxonomy_exists( $attribute_name ) ) { // This is attribute filter as color, size...
					$filter_terms = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

					if ( empty( $filter_terms ) ) {
						continue;
					}

					$attribute_info = wc_get_attribute( $attribute_id );

					foreach ( $filter_terms as $key => $term_slug ) {
						$clear_link = $filter_link;
						$clear_link = remove_query_arg( $filter_name, $clear_link );

						$term = get_term_by( 'slug', $term_slug, $attribute_name );

						if ( empty( $term ) ) {
							continue;
						}

						$clone_terms = $filter_terms;
						unset( $clone_terms[ $key ] );

						if ( empty( $clone_terms ) ) {
							$clear_link = remove_query_arg( $filter_name, $clear_link );
						} else {
							// Re add.
							$clear_link = add_query_arg( $filter_name, implode( ',', $clone_terms ), $clear_link );
						}

						$clear_links[] = [
							'url'     => $clear_link,
							'text'    => $term->name,
							'tooltip' => sprintf( __( 'Remove This %s', 'yhsshu' ), $attribute_info->name ),
							'class'   => 'remove-filter-link',
						];
					}
				} elseif ( 'rating_filter' === $filter_name ) {
					$filter_values = ! empty( $value ) ? explode( ',', wc_clean( wp_unslash( $value ) ) ) : array();

					if ( empty( $filter_values ) ) {
						continue;
					}

					foreach ( $filter_values as $key => $filter_value ) {
						$clear_link = $filter_link;
						$clear_link = remove_query_arg( $filter_name, $clear_link );

						$clone_values = $filter_values;
						unset( $clone_values[ $key ] );

						if ( empty( $clone_values ) ) {
							$clear_link = remove_query_arg( $filter_name, $clear_link );
						} else {
							// Re add.
							$clear_link = add_query_arg( $filter_name, implode( ',', $clone_values ), $clear_link );
						}

						$clear_links[] = [
							'url'     => $clear_link,
							'text'    => sprintf( _n( '%s star', '%s stars', $filter_value, 'yhsshu' ), $filter_value ),
							'tooltip' => sprintf( __( 'Remove This %s', 'yhsshu' ), __( 'Rating', 'yhsshu' ) ),
							'class'   => 'remove-filter-link',
						];
					}
				}/* elseif ( 'highlight_filter' === $filter_name ) {
					$clear_link        = $filter_link;
					$clear_link        = remove_query_arg( $filter_name, $clear_link );
					$highlight_options = Minimog_Woo::instance()->get_product_highlight_filter_options();

					$clear_link_text = isset( $highlight_options[ $value ] ) ? $highlight_options[ $value ] : $value;

					$clear_links[] = [
						'url'     => $clear_link,
						'text'    => $clear_link_text,
						'tooltip' => sprintf( __( 'Remove This %s', 'yhsshu' ), __( 'Highlight', 'yhsshu' ) ),
						'class'   => 'remove-filter-link',
					];
				}*/
			}

			if ( isset( $filters['min_price'] ) && isset( $filters['max_price'] ) ) {
				$clear_link = $filter_link;
				$clear_link = remove_query_arg( 'min_price', $clear_link );
				$clear_link = remove_query_arg( 'max_price', $clear_link );

				$clear_links[] = [
					'url'     => $clear_link,
					'text'    => wc_price( $filters['min_price'] ) . ' - ' . wc_price( $filters['max_price'] ),
					'tooltip' => sprintf( __( 'Remove This %s', 'yhsshu' ), __( 'Price', 'yhsshu' ) ),
					'class'   => 'remove-filter-link',
				];
			}
 
			$output = '<div class="yhsshu-active-filters-inner">';
			foreach ( $clear_links as $clear_link ) {
				$base_link_class = 'active-filtered-link';

				if ( ! empty( $clear_link['class'] ) ) {
					$base_link_class .= " {$clear_link['class']}";
				}

				if ( ! empty( $clear_link['tooltip'] ) ) {
					$base_link_class .= ' hint--bounce hint--top';
				}

				$tooltip_text = ! empty( $clear_link['tooltip'] ) ? $clear_link['tooltip'] : esc_html__( 'Remove This', 'yhsshu' );

				$clear_link['text'] =  $clear_link['text'];

				$output .= sprintf( '<a href="%1$s" class="%2$s" aria-label="%3$s"><span class="filter-link-text">%4$s</span></a>', $clear_link['url'], $base_link_class, $tooltip_text, $clear_link['text'] );
			}  
			$output .= '</div>';
			if ( ! empty( $clear_links ) ) {
				$clear_all_links = [
					'url'   => $this->get_shop_base_url(),
					'text'  => '<span class="lnil lnil-reload"></span>'.esc_html__( 'Reset All', 'yhsshu' ),
					'class' => 'reset-all',
					'tooltip' => esc_html__( 'Remove This', 'yhsshu' ),
				];
				$output .= sprintf( '<a href="%1$s" class="%2$s" aria-label="%3$s"><div class="filter-link-text">%4$s</div></a>', $clear_all_links['url'],'active-filtered-link reset-all', $clear_all_links['tooltip'], $clear_all_links['text'] );
			}
			return $output;
		}

  		public function get_category_list_by_selected($args = []){
  			extract($args);
  			$ids = [];
  			$taxonomy = 'product_cat';
  			foreach ($category_filter as $value) {
  				$term = get_term_by('slug', $value, $taxonomy);
  				$ids[] = $term->term_id;
  			}
  			
  			$term_args = [
				'taxonomy'   => $taxonomy,
				'hide_empty' => '1',
				'include'    =>  $ids,
				'menu_order' => false,
			];
			if ( 'order' === $category_orderby ) {
				$term_args['orderby']  = 'meta_value_num';
				$term_args['meta_key'] = 'order';
			}
			$terms = get_terms( $term_args );

  			$chosen_terms = $this->get_chosen_terms( 'filter_product_cat' );
  			$base_link = $this->get_shop_active_filters_url(); 
  			if(!empty($default_title)): 
  				$item_all_cls = 'wc-layered-nav-term';
  				$item_all_cls .= !isset( $_GET[ 'filter_product_cat' ] ) ? ' chosen' : '';
  				$link_all = remove_query_arg( 'filter_product_cat', $base_link );
  				?>
                <li class="<?php echo esc_attr($item_all_cls) ?>">
                    <a href="<?php echo esc_url($link_all) ?>" class="filter-link all"><span class="title"><?php echo esc_html($default_title) ?></span></a>
                </li>
            <?php endif; ?>
            <?php 

            foreach ($terms as $term): 
            	$option_is_set = in_array( $term->term_id, $chosen_terms );
            	$count       = yhsshu_Woo_Query::instance()->get_hierarchy_tax_counts( [$term->term_id], 'product_cat', 'or', false  );
            	if ( $count <= 0 ) {
					continue;
				}  
				$current_filter = isset( $_GET[ 'filter_product_cat' ] ) ? explode( ',', wc_clean( $_GET[ 'filter_product_cat' ] ) ) : array();
				$current_filter = array_map( 'intval', $current_filter );
				if ( ! in_array( $term->term_id, $current_filter ) ) {
					$current_filter[] = $term->term_id;
				}

				$link = remove_query_arg( 'filter_product_cat', $base_link );

				foreach ( $current_filter as $key => $value ) {
					// Exclude self so filter can be unset on click.
					if ( $option_is_set && $value === $term->term_id ) {
						unset( $current_filter[ $key ] );
					}
				}

				if ( ! empty( $current_filter ) ) {
					$link = add_query_arg( array(
						'filter_product_cat' => implode( ',', $current_filter ),
					), $link );
				}
				$item_class = 'wc-layered-nav-term';
            	if ( $option_is_set ) {
					$item_class .= ' chosen';
				}
        	?>
                <li class="<?php echo esc_attr($item_class) ?>">
                    <a href="<?php echo esc_url( $link ); ?>" class="filter-link"><span class="title"><?php echo esc_html($term->name) ?></span></a>
                </li>
            <?php endforeach; 

  		}

  		public function get_category_list_by_selected_search($args = []){
  			extract($args);
  			$ids = [];
  			$taxonomy = 'product_cat';
  			foreach ($category_filter as $value) {
  				$term = get_term_by('slug', $value, $taxonomy);
  				$ids[] = $term->term_id;
  			}
  			
  			$term_args = [
				'taxonomy'   => $taxonomy,
				'hide_empty' => '1',
				'include'    =>  $ids,
				'menu_order' => false,
			];
			if ( 'order' === $category_orderby ) {
				$term_args['orderby']  = 'meta_value_num';
				$term_args['meta_key'] = 'order';
			}
			$terms = get_terms( $term_args );
 
  			if(!empty($default_title)): 
  				?>
                <li class="filter-cat-item active">
                    <a href="#" class="filter-link all" data-term-id="0"><span class="title"><?php echo esc_html($default_title) ?></span></a>
                </li>
            <?php endif; ?>
            <?php 

            foreach ($terms as $term): 
            	$count       = yhsshu_Woo_Query::instance()->get_hierarchy_tax_counts( [$term->term_id], 'product_cat', 'or', false  );
            	if ( $count <= 0 ) {
					continue;
				}  
        		?>
                <li class="filter-cat-item">
                    <a href="#" class="filter-link" data-term-id="<?php echo esc_attr($term->term_id)?>"><span class="title"><?php echo esc_html($term->name) ?></span></a>
                </li>
            <?php endforeach; 
  		}

  		public function get_category_list_filter($wg_id = '', $settings = []){
  			extract($settings);
  			$term_args = [
				'taxonomy'   => 'product_cat',
				'hide_empty' => '1',
				'parent'     => 0,
				'menu_order' => false,
			];
			if ( 'order' === $orderby ) {
				$term_args['orderby']  = 'meta_value_num';
				$term_args['meta_key'] = 'order';
			}
			 
			$terms = get_terms( $term_args );

			$term_count = count($terms);
			
 
			$content_class = 'display-'.$display_type;
			$content_class .= ' show-count-' . $items_count;
			$content_class .= ' enable-scrollable-'.$enable_scrollable;
			$content_class .= ' enable-loadmore-0 enable-collapse-0';
			$content_class .= ' list-style-'.$list_style_category;
			  
			?>
			<div id="<?php echo esc_attr($wg_id) ?>" class="widget yhsshu-widget yhsshu-widget-product-categories yhsshu-widget-wc-layered-nav">
                <div class="widget-content">
                	<?php if(!empty($wg_title)): ?>
                		<h4 class="widget-title"><span><?php echo esc_html($wg_title) ?></span></h4>
                	<?php endif; ?>
                    <div class="widget-content-inner <?php echo esc_attr($content_class) ?>">
                    	<?php $this->get_category_layered_nav_list($terms, $settings, $depth = 0); ?>
                    </div>
                </div>
            </div>
			<?php 
  		}
  		public function get_category_layered_nav_list($terms, $settings, $depth = 0){
  			extract($settings);

  			$found          = false;
  			$class = ['nav-list-cat'];
			if ( $depth > 0 ) {
				$class[] = 'children';
			}
			$chosen_terms   = $this->get_chosen_terms( 'filter_product_cat' );
  			echo '<ul class="' . esc_attr( implode( ' ', $class ) ) . '">';
        		$base_link = $this->get_shop_active_filters_url();
        		foreach ( $terms as $term ) {
        			$option_is_set = in_array( $term->term_id, $chosen_terms );
        			$child_ids     = get_terms( [
						'taxonomy' => 'product_cat',
						'child_of' => $term->term_id,  
						'fields'   => 'ids',
					] );

					$child_ids[] = $term->term_id;
					$count       = yhsshu_Woo_Query::instance()->get_hierarchy_tax_counts( $child_ids, 'product_cat', 'or', false  );

					if ( $count > 0 ) {
						$found = true;
					} else {
						continue;
					}

        			$current_filter = isset( $_GET[ 'filter_product_cat' ] ) ? explode( ',', wc_clean( $_GET[ 'filter_product_cat' ] ) ) : array();
					$current_filter = array_map( 'intval', $current_filter );
					if ( ! in_array( $term->term_id, $current_filter ) ) {
						$current_filter[] = $term->term_id;
					}

					$link = remove_query_arg( 'filter_product_cat', $base_link );

					foreach ( $current_filter as $key => $value ) {
						 
						// Exclude self so filter can be unset on click.
						if ( $option_is_set && $value === $term->term_id ) {
							unset( $current_filter[ $key ] );
						}
					}

					if ( ! empty( $current_filter ) ) {
						$link = add_query_arg( array(
							'filter_product_cat' => implode( ',', $current_filter ),
						), $link );
					}

					$item_class = [ 'yhsshu-layered-nav-term yhsshu-list-item' ];
					$link_class = 'filter-link';

					if ( $option_is_set ) {
						$item_class[] = 'chosen';
					}
					$count_html = '1' == $items_count ? '<span class="count">(' . $count . ')</span>' : '';

					echo '<li class="' . esc_attr( implode( ' ', $item_class ) ) . '">';
					printf(
						'<a href="%1$s" class="%2$s"><span class="title">%3$s</span>%4$s</a>',
						esc_url( $link ),
						esc_attr( $link_class ),
						esc_html( $term->name ),
						$count_html
					);
					if ( $show_hierarchy ) {
						$child_terms = get_terms( [
							'taxonomy'   => 'product_cat',
							'hide_empty' => 1,
							'parent'     => $term->term_id,
						] );

						if ( ! empty( $child_terms ) ) {
							$found |= $this->get_category_layered_nav_list( $child_terms, $settings, $depth + 1);
						}
					}
					echo '</li>';
        		}
            	  
            echo '</ul>';
  			 
  		}
  		public function get_chosen_terms( $filter_name ) {
			$terms = [];

			if ( ! empty( $_GET[ $filter_name ] ) ) {
				$terms = array_map( 'intval', explode( ',', $_GET[ $filter_name ] ) );
			}
			$taxonomies = get_object_taxonomies( 'product' );
	 
			if ( is_tax( $taxonomies ) ) {
				$terms[] = get_queried_object()->term_id;
			}

			return $terms;
		}

		public function get_sortby_list_filter($wg_id = '', $settings = []){
			extract($settings);
  			$orderby_options = array(
				'popularity' => esc_html__( 'Popularity', 'yhsshu' ),
				'rating'     => esc_html__( 'Average Rating', 'yhsshu' ),
				'sale'       => esc_html__( 'Sale', 'yhsshu' ),
				'date'       => esc_html__( 'New In', 'yhsshu' ),
				'price'      => esc_html__( 'Price Low to High', 'yhsshu' ),
				'price-desc' => esc_html__( 'Price High to Low', 'yhsshu' ),
            );
            $base_link = $this->get_shop_active_filters_url();

            $content_class = 'display-'.$display_type;
			$content_class .= ' enable-scrollable-'.$enable_scrollable;
			$content_class .= ' list-style-df';
            ?>
            <div id="<?php echo esc_attr($wg_id) ?>" class="widget yhsshu-widget yhsshu-widget-product-orderby yhsshu-widget-wc-layered-nav">
                <div class="widget-content">
                	<?php if(!empty($wg_title)): ?>
                		<h4 class="widget-title"><span><?php echo esc_html($wg_title) ?></span></h4>
                	<?php endif; ?>
                    <div class="widget-content-inner <?php echo esc_attr($content_class) ?>">
                    	<ul class="sortby-filter">
				            <?php 
				            foreach ( $orderby_options as $id => $name ){
				            	$current_filter = isset( $_GET[ 'orderby' ] ) ? wc_clean( $_GET[ 'orderby' ] ) : '';
				            	$link = add_query_arg( 'orderby', $id, $base_link );
				            	
								$item_class = [ 'yhsshu-layered-nav-term yhsshu-list-item orderby' ];
								$link_class = 'filter-link';

								if ( $current_filter == $id ) {
				            		$link = remove_query_arg( 'orderby', $base_link );
				            		$item_class[] = 'chosen';
								}
								  
								echo '<li class="' . esc_attr( implode( ' ', $item_class ) ) . '">';
									printf(
										'<a href="%1$s" class="%2$s" data-value="%3$s"><span class="title">%4$s</span></a>',
										esc_url( $link ),
										esc_attr( $link_class ),
										esc_attr( $id ),
										esc_html( $name )
									);
								echo '</li>';
				            }
				            ?>
            			</ul>
                    </div>
                </div>
            </div>
            <?php 
  		}
  		public function get_price_list_filter($wg_id = '', $settings = []){
  			extract($settings);
  			global $wp;

  			if ( '' === get_option( 'permalink_structure' ) ) {
				$form_action = remove_query_arg( array( 'page', 'paged', 'product-page' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
			} else {
				$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
			}

			//$form_action = $this->get_shop_active_filters_url();
			wp_enqueue_script( 'wc-price-slider' );

			$step = max( apply_filters( 'woocommerce_price_filter_widget_step', 10 ), 1 );
			$prices    = $this->get_filtered_price();
			$min_price = $prices->min_price;
			$max_price = $prices->max_price;
			$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );

			if ( wc_tax_enabled() && ! wc_prices_include_tax() && 'incl' === $tax_display_mode ) {
				$tax_class = apply_filters( 'woocommerce_price_filter_widget_tax_class', '' ); // Uses standard tax class.
				$tax_rates = WC_Tax::get_rates( $tax_class );

				if ( $tax_rates ) {
					$min_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $min_price, $tax_rates ) );
					$max_price += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max_price, $tax_rates ) );
				}
			}

			$min_price = apply_filters( 'woocommerce_price_filter_widget_min_amount', floor( $min_price / $step ) * $step );
			$max_price = apply_filters( 'woocommerce_price_filter_widget_max_amount', ceil( $max_price / $step ) * $step );
			if ( $min_price === $max_price ) {
				return;
			}
			$current_min_price = isset( $_GET['min_price'] ) ? floor( floatval( wp_unslash( $_GET['min_price'] ) ) / $step ) * $step : $min_price; 
			$current_max_price = isset( $_GET['max_price'] ) ? ceil( floatval( wp_unslash( $_GET['max_price'] ) ) / $step ) * $step : $max_price;
  			?>
  			<div id="<?php echo esc_attr($wg_id) ?>" class="widget widget_price_filter">
  				<div class="widget-content">
  					<?php if(!empty($wg_title)): ?>
                		<h4 class="widget-title"><span><?php echo esc_html($wg_title) ?></span></h4>
                	<?php endif; ?>
  					<div class="widget-content-inner">
  						<form method="get" action="<?php echo esc_url( $form_action ); ?>">
			                <div class="price-filter-widget price_slider_wrapper">
			                	<div class="price_slider" style="display:none;"></div>
			                    <div class="price_slider_amount" data-step="<?php echo esc_attr( $step ); ?>"> 
			                    	<label class="screen-reader-text" for="min_price"><?php esc_html_e( 'Min price', 'yhsshu' ); ?></label>
									<input type="text" id="min_price" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>" placeholder="<?php echo esc_attr__( 'Min price', 'yhsshu' ); ?>" />
									<label class="screen-reader-text" for="max_price"><?php esc_html_e( 'Max price', 'yhsshu' ); ?></label>
									<input type="text" id="max_price" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>" placeholder="<?php echo esc_attr__( 'Max price', 'yhsshu' ); ?>" />
				                    <button type="submit" class="yhsshu-btn btn-outline button"><?php echo esc_html__( 'Filter', 'yhsshu' ); ?></button>
				                    <div class="price_label" style="display:none;">
										<span class="from"></span> &ndash; <span class="to"></span>
									</div>
									<?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
								</div>
			                </div>
			            </form>
  						  
  					</div>
  				</div>
  			</div>
		 	<?php 
  		}

  		public function get_filtered_price() {
			global $wpdb;
			 
			$args = yhsshu_Woo_Query::instance()->yhsshu_query_args;
			 
			$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
			$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();
  
			foreach ( $meta_query + $tax_query as $key => $query ) {
				if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
					unset( $meta_query[ $key ] );
				}
			}
 		

			//$tax_query  = yhsshu_Woo_Query::instance()->get_main_tax_query();
			//$meta_query = yhsshu_Woo_Query::instance()->get_main_meta_query();

			$tax_query       = new WP_Tax_Query( $tax_query );
			$meta_query      = new WP_Meta_Query( $meta_query );

			$search     = yhsshu_Woo_Query::instance()->get_main_search_query_sql();

			$meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
			$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
			$search_query_sql = $search ? ' AND ' . $search : '';

			$sql = "
				SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
				FROM {$wpdb->wc_product_meta_lookup}
				WHERE product_id IN (
					SELECT ID FROM {$wpdb->posts}
					" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
					WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
				)';
			 
			$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

			return $wpdb->get_row( $sql );  
 
		}

		public function get_attribute_filter($wg_id = '', $settings = []){
			extract($settings);

			if( $attribute_filter == '') return;
			$taxonomy = $this->get_attribute_taxonomy( $attribute_filter );
			$query_type = isset( $query_type ) ? $query_type : 'and';
			$display_type = isset( $display_type ) ? $display_type : 'list';
			$items_count = isset( $items_count ) ? $items_count : '0';
			$show_labels = isset( $show_labels ) ? $show_labels : 'on';
			$enable_scrollable = '1';
			$enable_load_more = '0';
			$enable_collapse = '0';
 
			if ( ! taxonomy_exists( $taxonomy ) ) {
				return;
			}

			$terms = get_terms( $taxonomy, array( 'hide_empty' => '1' ) );
			if ( 0 === count( $terms ) ) {
				return;
			}
			 
			//$term_counts = wc_get_container()->get(Filterer::class)->get_filtered_term_product_counts( wp_list_pluck( $terms,'term_id' ), $taxonomy, $query_type);
			$term_counts = yhsshu_Woo_Query::instance()->get_filtered_term_product_counts(wp_list_pluck( $terms,'term_id' ), $taxonomy, $query_type, false );
			$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
			 
			$found              = false;
			$base_link          = $this->get_shop_active_filters_url();
			
			$content_class = 'show-count-' . $items_count;
			$content_class .= ' enable-scrollable-' . $enable_scrollable;
			$content_class .= ' enable-loadmore-' . $enable_load_more;
			$content_class .= ' enable-collapse-' . $enable_collapse;
			$content_class .= ' ' . $taxonomy;

			$attr_id   = wc_attribute_taxonomy_id_by_name( $taxonomy );
			$attr_info = wc_get_attribute( $attr_id );

			if ( 'swatches' === $list_style ) {
				switch ( $attr_info->type ) {
					case 'color':
						$content_class .= ' list-style-color';
						break;
					case 'image':
						$content_class .= ' list-style-image';
						break;
					case 'text':
					default:
						$content_class .= ' list-style-text';
						break;
				}
				$content_class .= ' show-label-'.$show_labels;
			} elseif ( 'checkbox' === $list_style ) {
				$content_class .= ' list-style-checkbox';
			} else {
				$content_class .= ' list-style-' . $list_style;
			}

			?>
			<div id="<?php echo esc_attr($wg_id) ?>" class="widget yhsshu-widget widget_layered_nav woocommerce-widget-layered-nav yhsshu-widget-layered-nav">
                <div class="widget-content">
                	<?php if(!empty($wg_title)): ?>
                		<h4 class="widget-title"><span><?php echo esc_html($wg_title) ?></span></h4>
                	<?php endif; ?>
                    <div class="widget-content-inner <?php echo esc_attr($content_class) ?>">
                    	<ul class="attribute-filter display-<?php echo esc_attr($display_type) ?>">
                    		<?php 
                    			foreach ( $terms as $term ) {
									$current_values = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
									$option_is_set  = in_array( $term->slug, $current_values, true );
									$count          = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

									// Skip the term for the current archive.
									$current_term_id = absint( is_tax() ? get_queried_object()->term_id : 0 );
									$current_term_slug = absint( is_tax() ? get_queried_object()->slug : 0 );
									if ( $current_term_id === $term->term_id ) {
										continue;
									}

									// Only show options with count > 0.
									if ( 0 < $count ) {
										$found = true;
									} elseif ( 0 === $count && ! $option_is_set ) {
										continue;
									}

									$filter_name = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
									// phpcs:ignore WordPress.Security.NonceVerification.Recommended
									$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
									$current_filter = array_map( 'sanitize_title', $current_filter );

									if ( ! in_array( $term->slug, $current_filter, true ) ) {
										$current_filter[] = $term->slug;
									}

									$link = remove_query_arg( $filter_name, $base_link );

									// Add current filters to URL.
									foreach ( $current_filter as $key => $value ) {
										// Exclude query arg for current term archive term.
										if ( $value === $current_term_slug ) {
											unset( $current_filter[ $key ] );
										}

										// Exclude self so filter can be unset on click.
										if ( $option_is_set && $value === $term->slug ) {
											unset( $current_filter[ $key ] );
										}
									}

									if ( ! empty( $current_filter ) ) {
										asort( $current_filter );
										$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

										// Add Query type Arg to URL.
										if ( 'or' === $query_type && ! ( 1 === count( $current_filter ) && $option_is_set ) ) {
											$link = add_query_arg( 'query_type_' . wc_attribute_taxonomy_slug( $taxonomy ), 'or', $link );
										}
										$link = str_replace( '%2C', ',', $link );
									}

									$item_link_class = 'filter-link term-link';
									$swatch_span  = $tooltip_span  ='';
									if ( 'swatches' === $list_style ) :
										switch ( $attr_info->type ) :
											case 'color':
												$color           = get_term_meta( $term->term_id, 'wpcvs_color', true ) ? : '#fff';
												$tooltip_text   = get_term_meta( $term->term_id, 'wpcvs_tooltip', true ) ? : '';
												$item_link_class .= ' yhsshu-ttip tt-top';
												$swatch_span     = '<div class="term-color"><span style="background: ' . $color . '"></span></div>';
												$tooltip_span  = '<span class="tt-txt">'.$tooltip_text.'</span>';
												break;
											case 'image':
												$val             = get_term_meta( $term->term_id, 'wpcvs_image', true );
												$tooltip_text   = get_term_meta( $term->term_id, 'wpcvs_tooltip', true ) ? : '';
												$item_link_class .= ' yhsshu-ttip tt-top';
												$tooltip_span  = '<span class="tt-txt">'.$tooltip_text.'</span>';
												if ( ! empty( $val ) ) {
													$image_url = wp_get_attachment_thumb_url( $val );
												} else {
													$image_url = wc_placeholder_img_src();
												}

												$swatch_span = '<div class="term-shape"><span style="background-image: url(' . esc_attr( $image_url ) . ');"></span></div>';

												break;
											case 'text':
											default:
												break;
										endswitch;
									endif;
									if ( 'checkbox' === $list_style && $attr_info->type == 'color') :
										$color = get_term_meta( $term->term_id, 'wpcvs_color', true ) ? : '#fff';
										$swatch_span = '<span class="term-color" style="background: ' . $color . '"></span>';
									endif;

									$count_html = '';
									if ( '1' === $items_count ) {
										$count_html = ' ' . apply_filters( 'woocommerce_layered_nav_count', '<span class="count">(' . absint( $count ) . ')</span>', $count, $term );
									}
						 
									if ( $count > 0 || $option_is_set ) {
										$link      = apply_filters( 'woocommerce_layered_nav_link', $link, $term, $taxonomy );
										$term_html = '<a rel="nofollow" href="' . esc_url( $link ) . '" class="' . esc_attr( $item_link_class ) . '">'.$tooltip_span.$swatch_span.'<span class="title">' . esc_html( $term->name ) . '</span></a>' . $count_html;
									} else {
										$link      = false;
										$term_html = '<div>' . $swatch_span .'<span class="title">' . esc_html( $term->name ) . '</span>'. $count_html.'</div>';
									}
						 

									echo '<li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term ' . ( $option_is_set ? 'woocommerce-widget-layered-nav-list__item--chosen chosen' : '' ) . '">';
									// phpcs:ignore WordPress.Security.NonceVerification.Recommended, WordPress.Security.EscapeOutput.OutputNotEscaped
									echo apply_filters( 'yhsshu_wc_layered_nav_term_html', $term_html, $term, $link, $count );
									echo '</li>';
								}
                    		?>
                		</ul>
                    </div>
                    <?php 
                    $items_loadmore_display = 8;
					if( $enable_load_more == '1' && count($term_counts) > $items_loadmore_display){  
						echo '<span class="yhsshu-toogle-more" data-display="'.esc_attr($items_loadmore_display).'" data-less="'.esc_attr__( 'Less', 'yhsshu' ).'" data-more="'.esc_attr__( 'More', 'yhsshu' ).'" ><span class="text">' . esc_html__( 'More', 'yhsshu' ) . '</span><span class="yhsshu-icon lnil lnil-chevron-down"></span></span>';
					}
                    ?>
                </div>
            </div>
			<?php 
		}
		public function get_attribute_taxonomy( $attribute_filter ) {
			if ( isset( $attribute_filter ) ) {
				return wc_attribute_taxonomy_name( $attribute_filter );
			}

			$attribute_taxonomies = wc_get_attribute_taxonomies();

			if ( ! empty( $attribute_taxonomies ) ) {
				foreach ( $attribute_taxonomies as $tax ) {
					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
						return wc_attribute_taxonomy_name( $tax->attribute_name );
					}
				}
			}

			return '';
		}

		public function get_product_sale_badge_percentage( $product ) {
			 
			$percentage = 0;
			if($product->get_type() == 'variable'){
                $regular_price = $product->get_variation_regular_price('max');
                $sale_price = $product->get_variation_sale_price('max');
               
            }else{
                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();
            }
 
			if ( isset($regular_price) && $regular_price > 0 && isset($sale_price) ) {
				$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
			}
				 
			return $percentage;
 
		}
		public function get_recent_viewed_products(){
			global $product;

			$viewed_pids = [];
			$posts_per_page     = (int)yhsshu()->get_theme_opt('product_recent_viewed_per_page', 8);

			if ( isset( $_COOKIE['recent_viewed_products_cookie'] ) ) {
				$viewed_pids = array_map( 'intval', explode( ',', $_COOKIE['recent_viewed_products_cookie'] ) );
 
				$current_pid = $product->get_id();
 
				$viewed_pids = array_values( array_diff( $viewed_pids, [ $current_pid ] ) );
				 
			}

			if ( empty( $viewed_pids ) ) {
				return false;
			}

			$viewed_ids = array_slice( $viewed_pids, 0, $posts_per_page );
 
			$products = wc_get_products( [
				'include' => $viewed_ids,
				'orderby' => 'include',
			] );

			return $products;
		}

		public function get_cross_sell_product(){
			  
			$cross_sells_ids = yhsshu()->get_page_opt('product_cross_sell_ids', []);
			if( count($cross_sells_ids) <= 0)
				return false;

			$products = wc_get_products( [
				'include' => $cross_sells_ids,
				'orderby' => 'include',
			] );

			return $products;
		}

		public function get_loop_product_attribute_count($product){  
			if('variable' != $product->get_type()) return ''; 
			$attributes = $product->get_variation_attributes();
			$taxonomy_terms = array(); 
			 
			if(count($attributes) > 0){
				foreach ($attributes as $attribute_name => $att) {
					$attr_id = wc_attribute_taxonomy_id_by_name( $attribute_name );
					$attr       = wc_get_attribute( $attr_id );
					$count_terms = count($att);
					$taxonomy_terms[$attr->name] = $count_terms;
				}
			}
			if(count($taxonomy_terms) > 0){
				$term_htmls = [];
				foreach ($taxonomy_terms as $att_name => $count) {
					$term_htmls[] = '<span class="term-count-item">'.$count.' '.$att_name.'</span>';
				}
				return '<div class="att-term-count">' . implode( ', ', $term_htmls ) . '</div>';
			} 
			
			return ''; 
		}
    }
}