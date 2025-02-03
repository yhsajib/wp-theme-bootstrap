<div class="yhsshu-social-icons layout-2">
	<?php 
		foreach ($settings['social_list'] as $key => $value): 
			$social_link = isset($value['social_link']) ? $value['social_link'] : '';
			$link_key = $widget->get_repeater_setting_key( 'content', 'value', $key );
			if ( ! empty( $social_link['url'] ) ) {
				$widget->add_render_attribute( $link_key, 'href', $social_link['url'] );

				if ( $social_link['is_external'] ) {
					$widget->add_render_attribute( $link_key, 'target', '_blank' );
				}

				if ( $social_link['nofollow'] ) {
					$widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
				}
			}
			$link_attributes = $widget->get_render_attribute_string( $link_key );
			?>
			<div class="box-item">
				<?php if (!empty( $value['social_link']['url'])) : ?>
				<a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
					<?php endif; ?>
						<?php if(! empty( $value['social_icon']['value'] )): ?>
                            <?php \Elementor\Icons_Manager::render_icon( $value['social_icon'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-fancy-icon yhsshu-icon' ], 'i' );?>
                        <?php endif; ?>
						<div class="title-name">
							<?php if (!empty($value['social_name'])) : ?>
								<span>
									<?php echo yhsshu_print_html($value['social_name']); ?>
								</span>
							<?php endif; ?>
						</div>
					<?php if (!empty( $value['social_link']['url'])) : ?>
				</a>
				<?php endif; ?>
			</div>
			<?php
		endforeach; 
	?>
</div>