<?php

use Elementor\Icons_Manager;
use Elementor\Utils;

Icons_Manager::enqueue_shim();
$default_settings = [
    'col_xxl' => '3',
    'col_xl' => '3',
    'col_lg' => '2',
    'col_md' => '2',
    'col_sm' => '2',
    'col_xs' => '1',
    'content_list' => []
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$col_xxl = 'col-xxl-' . str_replace('.', '', 12 / floatval($settings['col_xxl']));
$col_xl  = 'col-xl-' . str_replace('.', '', 12 / floatval($settings['col_xl']));
$col_lg  = 'col-lg-' . str_replace('.', '', 12 / floatval($settings['col_lg']));
$col_md  = 'col-md-' . str_replace('.', '', 12 / floatval($settings['col_md']));
$col_sm  = 'col-sm-' . str_replace('.', '', 12 / floatval($settings['col_sm']));
$col_xs  = 'col-' . str_replace('.', '', 12 / floatval($settings['col_xs']));
$item_class = trim(implode(' ', ['grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));
$grid_sizer = trim(implode(' ', [$col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$animate_cls = '';
if (!empty($item_animation)) {
    $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
}
$item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '200';

$img_size = !empty($img_size) ? $img_size : '600x600';
$layout_mode = $widget->get_setting('layout_mode', 'fitRows');
if (is_admin())
    $grid_class = 'yhsshu-grid-inner yhsshu-grid-masonry-adm row relative';
else
    $grid_class = 'yhsshu-grid-inner yhsshu-grid-masonry row relative overflow-hidden';

if (!$settings['wp_gallery']) {
    return;
}
$randGallery = $settings['wp_gallery'];
if ($settings['gallery_rand'] == 'rand') {
    shuffle($randGallery);
}

if ($layout_mode == 'masonry') {
    foreach ($randGallery as $key => $value) {
        if (!empty($grid_custom_columns[$key])) {
            $item_cls = $item_class;
            $image_size = $img_size;

            $col_xxl_c = 'col-xxl-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_xxl_c']));
            $col_xl_c = 'col-xl-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_xl_c']));
            $col_lg_c = 'col-lg-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_lg_c']));
            $col_md_c = 'col-md-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_md_c']));
            $col_sm_c = 'col-sm-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_sm_c']));
            $col_xs_c = 'col-xs-' . str_replace('.', '', 12 / floatval($grid_custom_columns[$key]['col_xs_c']));

            $item_cls = trim(implode(' ', ['grid-item', $col_xxl_c, $col_xl_c, $col_lg_c, $col_md_c, $col_sm_c, $col_xs_c]));

            if (!empty($grid_custom_columns[$key]['img_size_c']))
                $image_size = $grid_custom_columns[$key]['img_size_c'];

            $increase = $key + 1;
            $args_m[$key] = ['item_class' => $item_cls, 'img_size' => $image_size];
        } else {
            $args_m[$key] = [];
        }
    }
}
?>
<div class="yhsshu-grid yhsshu-image-gallery images-light-box layout-6" data-layout-mode="<?php echo esc_attr($layout_mode); ?>">
    <div class="<?php echo esc_attr($grid_class) ?>">
        <?php foreach ($randGallery as $key => $value) :
            $image = isset($value['id']) ? $value['id'] : '';
            $image_title = "layout-1.php";

            $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;

            if (!empty($image)) {
                $image_title = get_the_title($image);
                if (!empty($grid_custom_columns) && $grid_custom_columns[$key]['img_size_c']) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $image,
                        'thumb_size' => $grid_custom_columns[$key]['img_size_c'],
                        'class' => 'no-lazyload',
                    ));
                } else {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $image,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                }
                $thumbnail = $img['thumbnail'];
            }

            $increase = $key + 1;
            $data_settings = '';
            if (!empty($item_animation)) {
                $data_animation =  json_encode([
                    'animation'      => $item_animation,
                    'animation_delay' => ((float)$item_animation_delay * $increase)
                ]);
                $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
            }
        ?>
            <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls); ?>" <?php yhsshu_print_html($data_settings); ?>>
                <?php if (!empty($image)) : ?>
                    <div class="item-inner">
                        <?php echo wp_kses_post($thumbnail); ?>
                        <div class="up-icon">
                            <?php
                                if (!empty($grid_custom_items_url[$key]['item_url'])) {
                                    $link_attributes = 'href='.esc_url($grid_custom_items_url[$key]['item_url']).' target="_blank"';
                                }
                                else {
                                    $link_attributes = 'class="light-box" data-elementor-open-lightbox="no" href='.esc_url(wp_get_attachment_image_url($image, 'full')).' title='.esc_attr($image_title);
                                }
                            ?>
                            <a <?php echo yhsshu_print_html($link_attributes); ?>>
                                <?php if(!empty($settings['selected_icon']['value'] )): ?>
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-icon' ], 'i' );?>
                                <?php else: ?>
                                    <span class="x-line"></span>
                                    <span class="y-line"></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php if (!empty(wp_get_attachment_caption($image))) : ?>
                        <div class="image-caption">
                            <?php echo wp_get_attachment_caption($image); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
    </div>
</div>