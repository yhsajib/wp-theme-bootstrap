<?php
extract($settings);

$tax = ['yhsshu-portfolio-category'];
$select_post_by = $widget->get_setting('select_post_by', 'term_selected');
$source = $post_ids = [];

if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
}

$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', -1);
$num_words = $widget->get_setting('num_words', 30);
$settings['layout']    = $settings['layout_'.$settings['post_type']];

$tab_style = yhsshu()->get_theme_opt('tab_style', 'style-df');

extract(yhsshu_get_posts_of_grid(
    'yhsshu-portfolio',
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids], 
    $tax
));

$drag_cursor = $widget->get_setting('setting_drag', false);
$drag_text   = $widget->get_setting('drag_text', 'Drag');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 3),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 3), 
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 3), 
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 2),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 2), 
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => (int)$gutter, 
    'center_slide'                  => (bool)$widget->get_setting('center_slide', false),
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500)
];


$widget->add_render_attribute( 'carousel', [
    'class'         => 'yhsshu-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$img_size = !empty( $img_size ) ? $img_size : '800x696';
$button_text = !empty($button_text) ? $button_text : esc_html__('READ MORE', 'yhsshu');

if ( ! empty( $settings['loadmore_link']['url'] ) ) {
    $widget->add_render_attribute( 'loadmore', 'href', $settings['loadmore_link']['url'] );
    if ( $settings['loadmore_link']['is_external'] ) {
        $widget->add_render_attribute( 'loadmore', 'target', '_blank' );
    }
    if ( $settings['loadmore_link']['nofollow'] ) {
        $widget->add_render_attribute( 'loadmore', 'rel', 'nofollow' );
    }
    $loadmore_text = !empty( $loadmore_text ) ? $loadmore_text : esc_html__( 'Load More', 'yhsshu' );
    $widget->add_render_attribute( 'loadmore', 'class', 'btn');
}

$data_settings = $item_anm_cls = '';
if ( !empty( $item_animation) ) {

    $item_anm_cls= ' yhsshu-animate yhsshu-invisible animated-'.$item_animation_duration;
    $item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '150';
    $data_animations = [
        'animation' => $item_animation,
        'animation_delay' => (float)$item_animation_delay
    ];
} 
?>
<?php if(!empty($posts) && count($posts)): ?>
<div class="yhsshu-swiper-slider yhsshu-portfolio-carousel layout-<?php echo esc_attr($settings['layout']);?> ">
    <?php if ($drag_cursor == "true") : ?>
        <div class="circle-cursor">
            <span><?php echo esc_html($drag_text); ?></span>
        </div>
    <?php endif; ?>
    <?php if ($select_post_by === 'term_selected' && $filter == "true"): ?>
        <div class="swiper-filter-wrap <?php echo esc_attr($tab_style); ?> d-flex <?php echo esc_html($settings['filter_alignment']);?>">
            <?php if(!empty($filter_default_title)): ?>
                <span class="filter-item active" data-filter-target="all">
                    <span class="cat-name"><?php echo esc_html($filter_default_title); ?></span>
                </span>
            <?php endif; ?>
            <?php foreach ($categories as $category):
                $category_arr = explode('|', $category);
                $term = get_term_by('slug',$category_arr[0], $category_arr[1]);
                ?>
                <span class="filter-item" data-filter-target="<?php echo esc_attr($term->slug); ?>">
                    <span class="cat-name"><?php echo esc_html($term->name); ?></span>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="yhsshu-swiper-slider-wrap yhsshu-carousel-inner relative">
        <div <?php yhsshu_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="yhsshu-swiper-wrapper swiper-wrapper">
                <?php
                $i = 0;
                foreach ($posts as $post):
                    $i = $i + 50;
                    $thumbnail = '';
                    if (has_post_thumbnail($post->ID)){
                        $img = yhsshu_get_image_by_size( array(
                            'post_id'  => $post->ID ,
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }

                    $filter_class = '';
                    if ($select_post_by === 'term_selected' && $filter == "true")
                        $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

                    $data_animations['animation_delay'] = ((float)$item_animation_delay + $i);
                    $data_animation =  json_encode($data_animations);
                    $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
                    ?>
                    <div class="yhsshu-swiper-slide swiper-slide" data-filter="<?php echo esc_attr($filter_class) ?>">
                        <div class="item-inner relative">
                            <?php if (!empty($thumbnail)) :?>
                                <div class="item-featured">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                </div>
                            <?php endif; ?>
                            <div class="item-content <?php echo esc_attr($item_anm_cls) ?>" <?php yhsshu_print_html($data_settings); ?>>
                                <div class="content-inner">
                                    <i class="item-icon yhsshui yhsshui-coffee-bean"></i>
                                    <h4 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                    </h4>
                                    <?php if ($show_category == 'true') : ?>
                                        <div class="item-tags">
                                            <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', '&nbsp/&nbsp', ''); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_excerpt == 'true') : ?>
                                        <div class="item-excerpt">
                                            <?php
                                            if (!empty($post->post_excerpt)) {
                                                echo wp_trim_words($post->post_excerpt, $num_words, null);
                                            } else {
                                                $content = strip_shortcodes($post->post_content);
                                                $content = apply_filters('the_content', $content);
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words($content, $num_words, null);
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_button == 'true') : ?>
                                        <div class="item-readmore">
                                            <a class="btn-more style-4" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                                <span><?php echo esc_html($button_text); ?></span>
                                                <i class="zmdi zmdi-arrow-right"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="box-title">
                                <div class="title-wrap">
                                    <h4 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                    </h4>
                                    <?php if ($show_category == 'true') : ?>
                                        <div class="item-tags">
                                            <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', '&nbsp/&nbsp', ''); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php yhsshu_arrow_template($settings, 'zmdi zmdi-arrow-left', 'zmdi zmdi-arrow-right'); ?>
        <div class="yhsshu-swiper-dots"></div>
    </div>
</div>
<?php endif; ?>