<?php
$widget->add_inline_editing_attributes('pricing_table_title_text');
$widget->add_inline_editing_attributes('pricing_table_button_text');

$link_type = $settings['pricing_table_button_url_type'];

$target = $rel = '';
if($link_type == 'link'){
    $link_url = get_permalink($settings['pricing_table_button_link_existing_content']);
} elseif ($link_type == 'url') {
    $link_url = $settings['pricing_table_button_link']['url'];
    $target = !empty($settings['pricing_table_button_link']['is_external'])?'_blank':'';
    $rel = !empty($settings['pricing_table_button_link']['nofollow'])?'nofollow':'';
}
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
$yhsshu_animate = $widget->get_setting('yhsshu_animate');
?>
<div class="yhsshu-pricing-wrap layout-2 <?php if (!empty($yhsshu_animate)){echo esc_attr($yhsshu_animate);} ?> <?php echo esc_attr($settings['style']);?>" data-wow-duration="1.4s" data-wow-delay="0.25s">
    <?php
    if ( $settings['show_highlight_text'] == 'true' ){
        ?><span class="pricing-price-note"><?php echo esc_html($settings['highlight_text']);?></span><?php
    }
    ?>
    <div class="pricing-table-container">
        <div class="inner-box">
            <div class="pricing-price-container">
                <div class="box-price-title">
                    <h3 class="pricing-table-title">
                        <span <?php yhsshu_print_html($widget->get_render_attribute_string( 'pricing_table_title_text' )); ?>><?php echo esc_html($settings['pricing_table_title_text']);?></span>
                    </h3>
                    <div class="price-money-inner">
                        <span class="pricing-price-value">
                            <span class="pricing-price-currency"><?php echo esc_html($settings['pricing_table_price_currency']); ?></span>
                            <?php echo esc_html($settings['pricing_table_price_value']); ?>
                        </span>

                        <span class="pricing-price-duration <?php if (empty($settings['pricing_table_price_separator'])){echo esc_attr('block-duration');} ?>">
                            <?php echo esc_html($settings['pricing_table_price_duration']); ?>
                        </span>
                    </div>
                </div>
                <div class="pricing-desc-container">
                    <?php echo esc_html($settings['pricing_table_description']); ?>
                </div>
            </div>
            <div class="pricing-list-container">
                <ul class="pricing-list">
                    <?php
                    foreach( $settings['fancy_text_list_items'] as $item ):
                        ?>
                        <li class="list-item <?php if ($item['pricing_list_item_slashed']){echo esc_attr('item-slashed');} ?>">
                            <?php
                            if($is_new):
                                \Elementor\Icons_Manager::render_icon( $item['pricing_list_item_icon'], [ 'aria-hidden' => 'true' ] );
                                ?>
                            <?php else: ?>
                                <i class="<?php echo esc_attr( $item['pricing_list_item_icon'] ); ?>"></i>
                            <?php endif; ?>
                            <span class="pricing-list-span"><?php echo esc_html($item['pricing_list_item_text']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="pricing-button-container yhsshu-button-wrapper">
                    <a class="pricing-price-button btn btn-outline-secondary-2 btn-fullwidth" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>">
                        <span <?php yhsshu_print_html($widget->get_render_attribute_string('pricing_table_button_text')); ?>><?php echo esc_html($settings['pricing_table_button_text']); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>