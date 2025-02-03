<?php
use Elementor\Icons_Manager;
use Elementor\Utils;
Icons_Manager::enqueue_shim();

$is_new = \Elementor\Icons_Manager::is_migration_allowed();
$img_size = !empty( $img_size ) ? $img_size : '387x387';
?>
<div class="yhsshu-food-menu-single layout-1">
    <div class="content-inner overflow-hidden">
        <?php
        $image    = isset($settings['image']) ? $settings['image'] : [];
        $title = isset($settings['title']) ? $settings['title'] : '';
        $sub_title    = isset($settings['sub_title']) ? $settings['sub_title'] : '';
        $price = isset($settings['price']) ? $settings['price'] : '';
        $description = isset($settings['description']) ? $settings['description'] : '';
        $thumbnail = '';
        if(!empty($image)) {
            $img = yhsshu_get_image_by_size( array(
                'attach_id'  => $image['id'],
                'thumb_size' => $img_size,
                'class' => 'no-lazyload',
            ));
            $thumbnail = $img['thumbnail'];
        }
        if (!empty($thumbnail)){
            ?>
            <div class="image-wrap">
                <div class="item-image">
                    <?php echo wp_kses_post($thumbnail); ?>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="info-wrap">
            <div class="item-price"><?php echo yhsshu_print_html($price); ?></div>
            <h3 class="item-name">
                <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
            </h3>
            <div class="item-sub-title"><?php echo yhsshu_print_html($sub_title); ?></div>
            <div class="item-icon">
            <?php
                if($is_new):
                    \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                    ?>
                <?php else: ?>
                    <i class="<?php echo esc_attr( $settings['icon'] ); ?>"></i>
                <?php endif; ?>
            </div>
            <div class="item-description"><?php echo yhsshu_print_html($description); ?></div>
        </div>
    </div>
</div>
