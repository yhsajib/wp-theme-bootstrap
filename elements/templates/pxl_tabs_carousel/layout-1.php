<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
$widget->add_render_attribute('opts', [
    'data-settings'  => wp_json_encode([
        'fade'       => (bool)$widget->get_setting("fade", false),
        'dots'       => (bool)$widget->get_setting("dots", false),
        'swipe'      => (bool)$widget->get_setting("swipe", false),
        'infinite'   => (bool)$widget->get_setting("infinite", false),
        'autoplay'   => (bool)$widget->get_setting("autoplay", false),
        'dots_style' => yhsshu()->get_theme_opt('swiper_pagination_style', 'style-df')
    ])
]);
$fade = $widget->get_setting("fade", "false");

$arrows_style = $widget->get_setting("arrows_style", "style-df");
$dots_style = yhsshu()->get_theme_opt('swiper_pagination_style', 'style-df');
extract($settings);
$widget->add_render_attribute('link_id', 'id', $link_to_tabs);
?>

<div class="yhsshu-tabs-carousel-container">
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner">
        <div class="yhsshu-tabs-carousel overflow-hidden" <?php yhsshu_print_html($widget->get_render_attribute_string('link_id')); ?> <?php yhsshu_print_html($widget->get_render_attribute_string('opts')); ?>>
            <?php foreach ($tabs_list_carousel as $key => $tab_carousel) : ?>
                <div class="yhsshu-carousel-item">
                    <?php
                    $content_key_carousel = $widget->get_repeater_setting_key('tab_content_carousel', 'tabs_list_carousel', $key);
                    $tabs_content_carousel = '';
                    if ($tab_carousel['content_type'] == 'template' && !empty($tab_carousel['content_template'])) {
                        $content_carousel = Elementor\Plugin::$instance->frontend->get_builder_content_for_display((int)$tab_carousel['content_template']);
                        $tabs_content_carousel = $content_carousel;
                    } elseif ($tab_carousel['content_type'] == 'df') {
                        $tabs_content_carousel = $tab_carousel['tab_content_carousel'];
                    }
                    $widget->add_render_attribute($content_key_carousel, [
                        'class' => ['tab-content-carousel'],
                        'id' => $element_id . '-' . $tab_carousel['_id'],
                    ]);
                    if ($tab_carousel['content_type'] == 'df') {
                        $widget->add_inline_editing_attributes($content_key_carousel, 'advanced');
                    }
                    ?>
                    <?php yhsshu_print_html($tabs_content_carousel); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php yhsshu_arrow_template($settings, 'yhsshu-icon zmdi zmdi-arrow-left', 'zmdi zmdi-arrow-right'); ?>
</div>