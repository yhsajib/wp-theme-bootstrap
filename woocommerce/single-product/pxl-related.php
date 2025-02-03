<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$product_layout = yhsshu()->get_theme_opt('product_layout', 'layout-1');

$col_xs = 1;  
$col_sm = 2;  
$col_md = 2;  
$col_lg = 3;
$col_xl = yhsshu()->get_opt('product_related_col_xl', 3);
$col_xxl = yhsshu()->get_opt('product_related_col_xxl', 3);

wp_enqueue_script( 'swiper' );
wp_enqueue_script( 'yhsshu-swiper' );

$arrow_style = yhsshu()->get_theme_opt('related_arrow_style', 'style-1');
$arrows_dots = yhsshu()->get_opt('product_related_arrows_dots', 'arrows');
$arrows = $arrows_dots == 'arrows' ? true : false;
$dots = $arrows_dots == 'dots' ? true : false;
$loop_carousel = yhsshu()->get_theme_opt('product_related_loop_carousel', '0') == '1' ? true : false ;
$gutter = 30;
if ($product_layout == 'layout-4') $gutter = 0;

$opts = [
	'slide_direction'               => 'horizontal',
	'slide_percolumn'               => 1, 
	'slide_mode'                    => 'slide', 
	'slides_to_show_xxl'            => (int)$col_xxl, 
	'slides_to_show'                => (int)$col_xl, 
	'slides_to_show_lg'             => (int)$col_lg, 
	'slides_to_show_md'             => (int)$col_md, 
	'slides_to_show_sm'             => (int)$col_sm, 
	'slides_to_show_xs'             => (int)$col_xs, 
	'slides_to_scroll'              => 1, 
	'slides_gutter'                 => $gutter,
	'center_slide'                  => false,
	'arrow'                         => $arrows,
	'dots'                          => $dots,
	'dots_style'                    => 'bullets',
	'autoplay'                      => false,
	'pause_on_hover'                => true,
	'pause_on_interaction'          => true,
	'delay'                         => 5000,
	'loop'                          => $loop_carousel,
	'speed'                         => 500,
];

yhsshu()->add_render_attribute( 'carousel', [
	'class'         => 'yhsshu-swiper-container',
	'dir'           => is_rtl() ? 'rtl' : 'ltr',
	'data-settings' => wp_json_encode($opts)],
	null,
	true
);

if ( $related_products ) : ?>
	<section class="related products">
		<div class="box-relatedtitle">
			<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'yhsshu' ) );
			$relate_title = yhsshu()->get_theme_opt('related_title', '');
			if (!empty($relate_title)){
				$heading = $relate_title;
			}
			$relate_sub_title = yhsshu()->get_theme_opt('related_sub_title', '');
			$relate_description = yhsshu()->get_theme_opt('related_description', '');
			if ( $heading ) : ?>
				<?php if (!empty($relate_sub_title)): ?>
					<div class="related_subtitle">
						<span><?php echo esc_html( $relate_sub_title ); ?></span>
					</div>
				<?php endif; ?>
				<h2 class="related_title"><?php echo esc_html( $heading ); ?></h2>
				<?php if (!empty($relate_description)): ?>
					<div class="related-description">
						<span><?php echo esc_html( $relate_description ); ?></span>
					</div>
				<?php endif; ?>
				<div class="yhsshu-divider"></div>
		</div>
		<?php endif; ?>
		<div class="yhsshu-product-grid yhsshu-product-loop-carousel">
			<div class="yhsshu-swiper-slider yhsshu-product-carousel relative">
				<div class="yhsshu-swiper-slider-inner yhsshu-carousel-inner">
					<div <?php yhsshu()->print_render_attribute_string( 'carousel' ); ?>>
						<div class="yhsshu-swiper-wrapper swiper-wrapper">
							<?php foreach ( $related_products as $related_product ) : ?>
								<div class="yhsshu-swiper-slide swiper-slide">
									<?php
									$post_object = get_post( $related_product->get_id() );
                        			setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                        			wc_get_template_part( 'yhsshu-content-product', esc_attr($product_layout));
                        			?>
                        		</div>
                        	<?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="yhsshu-swiper-arrows <?php echo esc_html($arrow_style); ?>">
                	<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev default">
                		<?php if (in_array($arrow_style, ['style-related-3', 'style-related-4'])) : ?>
                			<span class="yhsshu-icon zmdi zmdi-arrow-left"></span>
                		<?php else : ?>
                			<span class="yhsshu-icon yhsshui yhsshui-arrow-prev"></span>
                		<?php endif; ?>
                	</div>
                	<div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next default">
                		<?php if (in_array($arrow_style, ['style-related-3', 'style-related-4'])) : ?>
                			<span class="yhsshu-icon zmdi zmdi-arrow-right"></span>
                		<?php else : ?>
                			<span class="yhsshu-icon yhsshui yhsshui-arrow-next"></span>
                		<?php endif; ?>
                	</div>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
