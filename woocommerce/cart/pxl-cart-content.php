<?php
 
defined( 'ABSPATH' ) || exit;
?>

<div class="cart-list-content">
	<div class="cart-content-inner">
		<div class="cart-list-head">
			<div class="row gx-20">
				<div class="col-thumbs col-auto"><div class="thumb-content" style="width: 70px;"></div></div>
				<div class="col"> 
					<div class="row gx-20">
						<div class="col-name col"><span class="product-name"><?php esc_html_e( 'Product', 'yhsshu' ); ?></span></div>
						<div class="col-price col-2"><?php esc_html_e( 'Price', 'yhsshu' ); ?></div>
						<div class="col-quantity col-3"><?php esc_html_e( 'Quantity', 'yhsshu' ); ?></div>
						<div class="col-subtotal col-2"><?php esc_html_e( 'Subtotal', 'yhsshu' ); ?></div>
						<div class="col-remove col-auto" style="width: 44px;"></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="cart-list-body">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
				<?php
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				?>
				<?php 
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ): 
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="cart-list-item row gx-0 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="cart-item-thumbnail col-auto">
						<?php $image_border = yhsshu()->get_theme_opt('image_product_border', '0'); ?>
						<div class="product-thumbnail <?php echo esc_attr($image_border) == '1' ? 'border' : ''; ?>">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							if ( ! $product_permalink ) {
								echo ''.$thumbnail; 
							} else {
								printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); 
							}
							?>
						</div>
					</div>
					<div class="cart-item-info col">
						<div class="cart-item-info-inner row gx-20">
							<div class="item-name col-12 col-sm">
								<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $product_name, $cart_item, $cart_item_key ) . '&nbsp;' );
								} else {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_name ), $cart_item, $cart_item_key ) );
								}
								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item );  

								// Backorder notification.
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'yhsshu' ) . '</p>', $product_id ) );
								}
								?>
							</div>
							<div class="item-price col-auto col-sm-2">
								<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );?>
							</div>
							<div class="cart-item-quantify col-quantity col-auto col-sm-3">
								<div class="product-quantity">
									<?php
									if ( $_product->is_sold_individually() ) {
										$min_quantity = 1;
										$max_quantity = 1;
									} else {
										$min_quantity = 0;
										$max_quantity = $_product->get_max_purchase_quantity();
									}

									$product_quantity = woocommerce_quantity_input(
										array(
											'input_name'   => "$cart_item_key",
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $max_quantity,
											'min_value'    => $min_quantity,
											'product_name' => $product_name,
										),
										$_product,
										false
									);

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); 
									?>
								</div>
							</div>
							<div class="item-subtotal col-12 col-sm-2">
								<span class="lbl d-sm-none"><?php esc_html_e( 'Subtotal: ', 'yhsshu' ) ?></span>
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</div>
							<div class="col-remove col-auto" style="width: 44px;">
								<?php
									echo apply_filters( 
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove remove-from-cart-js" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s"><span class="zmdi zmdi-close" title="Remove"></span></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											 
											esc_attr( sprintf( __( 'Remove %s from cart', 'yhsshu' ), $product_name ) ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											esc_attr( $cart_item_key )
										),
										$cart_item_key
									);
								?>
								 
							</div>
						</div>
					</div>
					 
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php do_action( 'woocommerce_cart_contents' ); ?>
			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</div>
	</div>
	  
</div>