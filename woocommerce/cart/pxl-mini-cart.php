<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?> 

<div class="yhsshu-widget-cart-content">
	<?php if (!WC()->cart->is_empty()) : ?>
	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				/**
				 * Filter the product name.
				 *
				 * @param string $product_name Name of the product in the cart.
				 */
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
					<?php
					echo apply_filters(  
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="remove js-remove-from-cart remove_from_cart_button" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">x</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);
					?>
					<div class="cart-item-wrap">
						<div class="cart-item-thumbnail">
							<div class="product-thumbnail">
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo ''.$thumbnail; ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo ''.$thumbnail; ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
						<div class="cart-item-info"> 
							<div class="price-wrap">
								<?php echo '<div class="price">' . $product_price . '</div>'; ?>
							</div>
							<div class="product-info">
								<h5 class="product-name">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo ''.$product_name; ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo ''.$product_name;  ?>
										</a>
									<?php endif; ?>
								</h5>
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
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
											'input_name'   => $cart_item_key,
											'input_value'  => $cart_item['quantity'],
											'max_value'    => $max_quantity,
											'min_value'    => $min_quantity,
											'product_name' => $_product->get_name(),
										),
										$_product,
										false
									);
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );  
									?>
								</div>
							</div>
						</div>
					</div>
				</li>
				<?php
			}
		}
		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>
<?php else : ?>
	<?php wc_get_template( 'cart/cart-empty.php' ); ?>
<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>