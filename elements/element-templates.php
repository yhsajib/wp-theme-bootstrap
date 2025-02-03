<?php

use Elementor\Controls_Manager;
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;

add_action('wp_ajax_yhsshu_get_pagination_html', 'yhsshu_get_pagination_html');
add_action('wp_ajax_nopriv_yhsshu_get_pagination_html', 'yhsshu_get_pagination_html');
function yhsshu_get_pagination_html()
{
    try {
        if (!isset($_POST['query_vars'])) {
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'yhsshu'));
        }
        $query = new WP_Query(sanitize_text_field_array($_POST['query_vars']));
        ob_start();
        yhsshu()->page->get_pagination($query,  true);
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'yhsshu'),
                'data' => array(
                    'html' => $html,
                    'query_vars' => sanitize_text_field_array($_POST['query_vars']),
                    'post' => $query->have_posts()
                ),
            )
        );
    } catch (Exception $e) {
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}
add_action('wp_ajax_yhsshu_get_filter_html', 'yhsshu_get_filter_html');
add_action('wp_ajax_nopriv_yhsshu_get_filter_html', 'yhsshu_get_filter_html');
function yhsshu_get_filter_html()
{
    try {
        if (!isset($_POST['settings'])) {
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'yhsshu'));
        }
        $settings = sanitize_text_field_array($_POST['settings']);
        $loadmore_filter = sanitize_text_field($_POST['loadmore_filter']);
        if ($loadmore_filter == '1') {
            set_query_var('paged', 1);
            $limit = isset($settings['limit']) ? $settings['limit'] : '6';
            $limitx = (int)$limit * (int)$settings['paged'];
        } else {
            set_query_var('paged', $settings['paged']);
            $limitx = isset($settings['limit']) ? $settings['limit'] : '6';
        }
        extract(yhsshu_get_posts_of_grid(
            $settings['post_type'],
            [
                'source' => isset($settings['source']) ? $settings['source'] : '',
                'orderby' => isset($settings['orderby']) ? $settings['orderby'] : 'date',
                'order' => isset($settings['order']) ? $settings['order'] : 'desc',
                'limit' => $limitx,
                'post_ids' => isset($settings['post_ids']) ? $settings['post_ids'] : [],
            ],
            $settings['tax']
        ));
        $settings['filter_default_title'] = !empty($settings['filter_default_title']) ? $settings['filter_default_title'] : esc_html__('All', 'yhsshu');
        ob_start();

        ?>
        <span class="filter-item active" data-filter="*">
            <?php if ($settings['show_cat_count'] == '1') : ?>
                <span><?php echo count($posts); ?></span>
            <?php endif; ?>
            <?php echo esc_html($settings['filter_default_title']) ?>
        </span>
        <?php foreach ($categories as $category) : ?>
            <?php $category_arr = explode('|', $category); ?>
            <?php $term = get_term_by('slug', $category_arr[0], $category_arr[1]); ?>
            <?php
            $num = 0;
            foreach ($posts as $key => $post) {
                $this_terms = get_the_terms($post->ID, $settings['tax'][0]);
                $term_list = [];
                foreach ($this_terms as $t) {
                    $term_list[] = $t->slug;
                }
                if (in_array($term->slug, $term_list))
                    $num++;
            }
            if ($num > 0) :
                ?>
                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php if ($settings['show_cat_count'] == '1') : ?>
                        <span><?php echo esc_html($num); ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'yhsshu'),
                'data' => array(
                    'html' => $html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    } catch (Exception $e) {
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}

add_action('wp_ajax_yhsshu_load_more_product_grid', 'yhsshu_load_more_product_grid');
add_action('wp_ajax_nopriv_yhsshu_load_more_product_grid', 'yhsshu_load_more_product_grid');
function yhsshu_load_more_product_grid()
{
    try {
        if (!isset($_POST['settings'])) {
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'yhsshu'));
        }
        $settings = sanitize_text_field_array($_POST['settings']);
        set_query_var('paged', $settings['paged']);
        $query_type         = isset($settings['query_type']) ? $settings['query_type'] : 'recent_product';
        $post_per_page      = isset($settings['limit']) ? $settings['limit'] : 8;
        $product_ids        = isset($settings['product_ids']) ? $settings['product_ids'] : '';
        $categories         = isset($settings['categories']) ? $settings['categories'] : '';
        $param_args         = isset($settings['param_args']) ? $settings['param_args'] : [];

        $col_xxl = isset($settings['col_xxl']) ? 'col-xxl-' . str_replace('.', '', 12 / floatval($settings['col_xxl'])) : '';
        $col_xl = isset($settings['col_xl']) ? 'col-xl-' . str_replace('.', '', 12 / floatval($settings['col_xl'])) : '';
        $col_lg = isset($settings['col_lg']) ? 'col-lg-' . str_replace('.', '', 12 / floatval($settings['col_lg'])) : '';
        $col_md = isset($settings['col_md']) ? 'col-md-' . str_replace('.', '', 12 / floatval($settings['col_md'])) : '';
        $col_sm = isset($settings['col_sm']) ? 'col-sm-' . str_replace('.', '', 12 / floatval($settings['col_sm'])) : '';
        $col_xs = isset($settings['col_xs']) ? 'col-' . str_replace('.', '', 12 / floatval($settings['col_xs'])) : '';

        $item_class = trim(implode(' ', ['grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

        $loop = yhsshu_woocommerce_query($query_type, $post_per_page, $product_ids, $categories, $param_args);
        extract($loop);

        $data_animation = [];
        $animate_cls = '';
        $data_settings = '';
        if (!empty($settings['item_animation'])) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $settings['item_animation_duration'];
            $data_animation['animation'] = $settings['item_animation'];
            $data_animation['animation_delay'] = $settings['item_animation_delay'];
        }
        if ($posts->have_posts()) {
            ob_start();
            $d = 0;
            while ($posts->have_posts()) {
                $posts->the_post();
                global $product;
                $d++;
                $term_list = array();
                $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
                foreach ($term_of_post as $term) {
                    $term_list[] = $term->slug;
                }
                $filter_class = implode(' ', $term_list);

                if (!empty($data_animation)) {
                    $data_animation['animation_delay'] = ((float)$settings['item_animation_delay'] * $d);
                    $data_animations = json_encode($data_animation);
                    $data_settings = 'data-settings="' . esc_attr($data_animations) . '"';
                }

                ?>
                <div class="<?php echo trim(implode(' ', [$item_class, $filter_class, $animate_cls])); ?>" <?php yhsshu_print_html($data_settings); ?>>
                    <?php
                    do_action('woocommerce_before_shop_loop_item');
                    do_action('woocommerce_before_shop_loop_item_title');
                    do_action('woocommerce_shop_loop_item_title');
                    do_action('woocommerce_after_shop_loop_item_title');
                    do_action('woocommerce_after_shop_loop_item');
                    ?>

                </div>
                <?php
            }
            if ($settings['layout_mode'] == 'masonry')
                echo '<div class="grid-sizer ' . $item_class . '"></div>';
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => esc_html__('Load Post Grid Successfully!', 'yhsshu'),
                    'data' => array(
                        'html'  => $html,
                        'paged' => $settings['paged'],
                        'posts' => $posts,
                        'max' => $max,
                    ),
                )
            );
        } else {
            wp_send_json(
                array(
                    'status' => false,
                    'message' => esc_html__('Load Post Grid No More!', 'yhsshu')
                )
            );
        }
    } catch (Exception $e) {
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}

add_action('wp_ajax_yhsshu_load_more_post_grid', 'yhsshu_load_more_post_grid');
add_action('wp_ajax_nopriv_yhsshu_load_more_post_grid', 'yhsshu_load_more_post_grid');
function yhsshu_load_more_post_grid()
{
    try {
        if (!isset($_POST['settings'])) {
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'yhsshu'));
        }
        $settings = sanitize_text_field_array($_POST['settings']);
        set_query_var('paged', $settings['paged']);
        extract(yhsshu_get_posts_of_grid(
            $settings['post_type'],
            [
                'source' => isset($settings['source']) ? $settings['source'] : '',
                'orderby' => isset($settings['orderby']) ? $settings['orderby'] : 'date',
                'order' => isset($settings['order']) ? $settings['order'] : 'desc',
                'limit' => isset($settings['limit']) ? $settings['limit'] : '6',
                'post_ids' => isset($settings['post_ids']) ? $settings['post_ids'] : [],
            ],
            $settings['tax']
        ));
        ob_start();

        yhsshu_get_post_grid($posts, $settings);
        $html = ob_get_clean();
        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'yhsshu'),
                'data' => array(
                    'html' => $html,
                    'paged' => $settings['paged'],
                    'posts' => $posts,
                    'max' => $max,
                ),
            )
        );
    } catch (Exception $e) {
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}

if (!function_exists('yhsshu_get_post_grid')) {
    function yhsshu_get_post_grid($posts = [], $settings = [])
    {
        if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
            return;
        }
        extract($settings);

        $col_xxl = 'col-xxl-' . str_replace('.', '', 12 / floatval($settings['col_xxl']));
        $col_xl  = 'col-xl-' . str_replace('.', '', 12 / floatval($settings['col_xl']));
        $col_lg  = 'col-lg-' . str_replace('.', '', 12 / floatval($settings['col_lg']));
        $col_md  = 'col-md-' . str_replace('.', '', 12 / floatval($settings['col_md']));
        $col_sm  = 'col-sm-' . str_replace('.', '', 12 / floatval($settings['col_sm']));
        $col_xs  = 'col-' . str_replace('.', '', 12 / floatval($settings['col_xs']));

        $item_class = trim(implode(' ', ['grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

        $args_m = [];
        $settings['thumbnail'] = '';
        if ($layout_mode == 'masonry' && !empty($grid_custom_columns[0])) {
            foreach ($posts as $key => $post) {
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

                    if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                        $img_id = get_post_thumbnail_id($post->ID);
                        if ($img_id) {
                            $img = yhsshu_get_image_by_size(array(
                                'attach_id'  => $img_id,
                                'thumb_size' => $image_size,
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail = $img['thumbnail'];
                        } else {
                            $thumbnail = get_the_post_thumbnail($post->ID, $image_size);
                        }
                    }

                    $anm_cls = $data_settings = '';
                    if (!empty($grid_custom_columns[$key]['item_c_animation'])) {

                        $anm_cls = ' yhsshu-animate yhsshu-invisible animated-' . $grid_custom_columns[$key]['item_c_animation_duration'];
                        $item_c_animation_delay = !empty($grid_custom_columns[$key]['item_c_animation_delay']) ? $grid_custom_columns[$key]['item_c_animation_delay'] : '150';
                        $data_animation =  json_encode([
                            'animation'      => $grid_custom_columns[$key]['item_c_animation'],
                            'animation_delay' => $item_c_animation_delay
                        ]);
                        $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
                    }

                    $args_m[$key] = ['item_class' => $item_cls, 'thumbnail' => htmlspecialchars($thumbnail), 'anm_cls' => $anm_cls, 'data_setting' => $data_settings];
                } else {
                    $args_m[$key] = [];
                }
            }
        }
        $settings['item_class'] = $item_class;

        switch ($layout) {
            case 'post-list-1':
            yhsshu_get_post_list_layout1($posts, $settings, $args_m);
            break;
            case 'post-list-2':
            yhsshu_get_post_list_layout2($posts, $settings, $args_m);
            break;
            case 'post-list-3':
            yhsshu_get_post_list_layout3($posts, $settings, $args_m);
            break;
            case 'post-list-4':
            yhsshu_get_post_list_layout4($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-list-1':
            yhsshu_get_yhsshu_portfolio_list_layout1($posts, $settings, $args_m);
            break;
            case 'post-1':
            yhsshu_get_post_grid_layout1($posts, $settings, $args_m);
            break;
            case 'post-2':
            yhsshu_get_post_grid_layout2($posts, $settings, $args_m);
            break;
            case 'post-3':
            yhsshu_get_post_grid_layout3($posts, $settings, $args_m);
            break;
            case 'post-4':
            yhsshu_get_post_grid_layout4($posts, $settings, $args_m);
            break;
            case 'post-5':
            yhsshu_get_post_grid_layout5($posts, $settings, $args_m);
            break;
            case 'post-6':
            yhsshu_get_post_grid_layout6($posts, $settings, $args_m);
            break;
            case 'post-7':
            yhsshu_get_post_grid_layout7($posts, $settings, $args_m);
            break;
            case 'post-8':
            yhsshu_get_post_grid_layout7($posts, $settings, $args_m);
            break;
            case 'post-9':
            yhsshu_get_post_grid_layout9($posts, $settings, $args_m);
            break;
            case 'post-10':
            yhsshu_get_post_grid_layout3($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-1':
            yhsshu_get_post_grid_yhsshu_portfolio1($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-2':
            yhsshu_get_post_grid_yhsshu_portfolio2($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-3':
            yhsshu_get_post_grid_yhsshu_portfolio1($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-4':
            yhsshu_get_post_grid_yhsshu_portfolio2($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-5':
            yhsshu_get_post_grid_yhsshu_portfolio1($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-6':
            yhsshu_get_post_grid_yhsshu_portfolio1($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-7':
            yhsshu_get_post_grid_yhsshu_portfolio3($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-8':
            yhsshu_get_post_grid_yhsshu_portfolio8($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-9':
            yhsshu_get_post_grid_yhsshu_portfolio9($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-10':
            yhsshu_get_post_grid_yhsshu_portfolio10($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-11':
            yhsshu_get_post_grid_yhsshu_portfolio9($posts, $settings, $args_m);
            break;
            case 'yhsshu-portfolio-12':
            yhsshu_get_post_grid_yhsshu_portfolio12($posts, $settings, $args_m);
            break;
            default:
            return false;
            break;
        }
        if ($layout_mode == 'masonry')
            echo '<div class="grid-sizer ' . $item_class . '"></div>';
    }
}

function yhsshu_get_post_list_layout1($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :

        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
            $img_id = get_post_thumbnail_id($post->ID);
            if ($img_id) {
                $img = yhsshu_get_image_by_size(array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Continue reading', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                if (has_post_format('quote', $post->ID)) {
                    $quote_text = get_post_meta($post->ID, 'featured-quote-text', true);
                    $quote_cite = get_post_meta($post->ID, 'featured-quote-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-quote">
                        <div class="format-wrap">
                            <div class="quote-inner row">
                                <div class="inner-left col-10">
                                    <div class="quote-text">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text); ?></a>
                                    </div>
                                    <div class="yhsshu-divider"></div>
                                    <?php
                                    if (!empty($quote_cite)) {
                                        ?>
                                        <p class="quote-cite">
                                            <?php echo esc_html($quote_cite) . esc_html(' - Quote', 'yhsshu'); ?>
                                        </p>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="inner-right col-2 d-flex justify-content-center align-items-center">
                                    <div class="quote-icon">
                                        <span>"</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('link', $post->ID)) {
                    $link_url = get_post_meta($post->ID, 'featured-link-url', true);
                    $link_text = get_post_meta($post->ID, 'featured-link-text', true);
                    $link_cite = get_post_meta($post->ID, 'featured-link-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-link">
                        <div class="format-wrap">
                            <div class="link-inner row">
                                <div class="inner-left col-10">
                                    <div class="link-text">
                                        <a target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                                    </div>
                                    <div class="yhsshu-divider"></div>
                                    <?php if (!empty($link_cite)) : ?>
                                        <p class="link-cite">
                                            <?php echo esc_attr($link_cite) . esc_html(' - Quote', 'yhsshu'); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="inner-right col-2 d-flex justify-content-center align-items-center">
                                    <div class="link-icon">
                                        <a href="<?php echo esc_url($link_url); ?>"><span class="yhsshui-link"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                    $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                    if (isset($thumbnail)) {
                        ?>
                        <div class="item-featured">
                            <div class="post-image">                       
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                <?php
                                if ($show_date == 'true') : ?>
                                    <div class="post-date">
                                        <div class="post-day"> SD
                                            <?php echo get_the_date('d', $post->ID); ?>
                                        </div>
                                        <div class="post-month-year">
                                            <?php echo get_the_date('M y', $post->ID); ?>
                                        </div>
                                    </div>
                                <?php endif;
                                if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                                    <div class="yhsshu-media-popup featured-video">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                                <i class="yhsshui-play-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;
                                if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                                    $filetype = wp_check_filetype($audio_url)['type'];
                                if ($filetype == 'audio/mpeg') : ?>
                                    <div class="yhsshu-media-popup featured-audio">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                                <i class="yhsshui-volume"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="item-content row">
                    <div class="item-left col-md-7 col-xl-8">
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
                        <?php if ($show_excerpt == 'true') : ?>
                            <div class="yhsshu-divider"></div>
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
                            <?php if ($show_button == 'true') : ?>
                                <div class="item-readmore yhsshu-button-wrapper">
                                    <a class="btn btn-outline-secondary" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="item-right col-md-5 col-xl-4">
                        <?php
                        if ($show_author == 'true' || $show_comment == 'true') {
                            ?>
                            <div class="post-metas">
                                <div class="meta-inner">
                                    <?php if ($show_author == 'true') : ?>
                                        <span class="post-author">
                                            <span class="label"><?php echo esc_html__('Written By', 'yhsshu'); ?>&nbsp;<a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a></span>
                                        </span>
                                    <?php endif; ?>
                                    <?php
                                    $posttags = get_the_tags($post->ID);
                                    ?>
                                    <span class="post-tags">
                                        <span class="label"><?php echo esc_html('TAGS:', 'yhsshu'); ?></span>
                                        <?php if ($posttags) {
                                            foreach ($posttags as $tag) {
                                                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                            }
                                        }; ?>
                                    </span>
                                    <?php if ($show_comment == 'true') : ?>
                                        <span class="post-comments">
                                            <span class="label"><?php echo esc_html('COMMENTS:', 'yhsshu'); ?></span>
                                            <a href="<?php echo get_comments_link($post->ID); ?>">
                                                <span><?php comments_number(esc_html__('No Comments', 'yhsshu'), esc_html__(' 1 Comment', 'yhsshu'), esc_html__(' % Comments', 'yhsshu'), $post->ID); ?></span>
                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php ?>
                                    <span class="post-share">
                                        <span class="label"><?php echo esc_html('SHARE:', 'yhsshu'); ?></span>
                                        <?php yhsshu()->blog->get_post_share($post->ID); ?>
                                    </span>
                                    <?php ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
endforeach;
}

function yhsshu_get_post_list_layout2($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :

        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;

        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
            $img_id = get_post_thumbnail_id($post->ID);
            if ($img_id) {
                $img = yhsshu_get_image_by_size(array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Continue reading', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner row align-items-center">
                <?php
                if (has_post_format('quote', $post->ID)) {
                    $quote_text = get_post_meta($post->ID, 'featured-quote-text', true);
                    $quote_cite = get_post_meta($post->ID, 'featured-quote-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-quote">
                        <div class="format-wrap">
                            <div class="quote-inner">
                                <div class="quote-icon">
                                    <span>"</span>
                                </div>
                                <div class="quote-text">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text); ?></a>
                                </div>
                                <div class="yhsshu-divider"></div>
                                <?php
                                if (!empty($quote_cite)) {
                                    ?>
                                    <p class="quote-cite">
                                        <?php echo esc_html($quote_cite); ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('link', $post->ID)) {
                    $link_url = get_post_meta($post->ID, 'featured-link-url', true);
                    $link_text = get_post_meta($post->ID, 'featured-link-text', true);
                    $link_cite = get_post_meta($post->ID, 'featured-link-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-link">
                        <div class="format-wrap">
                            <div class="link-inner">
                                <div class="link-icon">
                                    <a href="<?php echo esc_url($link_url); ?>"><span class="yhsshui-link"></span></a>
                                </div>
                                <div class="link-text">
                                    <a target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                                </div>
                                <div class="yhsshu-divider"></div>
                                <?php if (!empty($link_cite)) : ?>
                                    <p class="link-cite">
                                        <?php echo esc_attr($link_cite); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                    $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                    if (isset($thumbnail)) {
                        ?>
                        <div class="item-featured col-md-6 col-12">
                            <div class="post-image">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                <?php
                                if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                                    <div class="yhsshu-media-popup featured-video">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                                <i class="yhsshui-play-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;
                                if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                                    $filetype = wp_check_filetype($audio_url)['type'];
                                if ($filetype == 'audio/mpeg') : ?>
                                    <div class="yhsshu-media-popup featured-audio">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                                <i class="yhsshui-volume"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif;
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="item-content col-md-6 col-12">
                    <?php if ($show_category == 'true') : ?>
                        <span class="post-category">
                            <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                        </span>
                    <?php endif; ?>
                    <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
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
                    <?php
                    if ($show_author == 'true' || $show_comment == 'true' || $show_date == 'true') {
                        ?>
                        <div class="post-metas">
                            <div class="meta-inner d-flex">
                                <?php if ($show_author == 'true') : ?>
                                    <div class="post-author">
                                        <span class="label"><?php echo esc_html__('by', 'yhsshu'); ?>&nbsp;<a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($show_date == 'true') : ?>
                                    <div class="post-date">
                                        <?php echo get_the_date('', $post->ID); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($show_comment == 'true') : ?>
                                    <div class="post-comments">
                                        <a href="<?php echo get_comments_link($post->ID); ?>">
                                            <span><?php comments_number(esc_html__('No Comments', 'yhsshu'), esc_html__(' 1 Comment', 'yhsshu'), esc_html__(' % Comments', 'yhsshu'), $post->ID); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
endforeach;
}

function yhsshu_get_post_list_layout3($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
            $img_id = get_post_thumbnail_id($post->ID);
            if ($img_id) {
                $img = yhsshu_get_image_by_size(array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Continue reading', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                if (has_post_format('quote', $post->ID)) {
                    $quote_text = get_post_meta($post->ID, 'featured-quote-text', true);
                    $quote_cite = get_post_meta($post->ID, 'featured-quote-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-quote">
                        <div class="format-wrap">
                            <div class="quote-inner row">
                                <div class="inner-left col-10">
                                    <div class="quote-text">
                                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text); ?></a>
                                    </div>
                                    <div class="yhsshu-divider"></div>
                                    <?php
                                    if (!empty($quote_cite)) {
                                        ?>
                                        <p class="quote-cite">
                                            <?php echo esc_html($quote_cite); ?>
                                        </p>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="inner-right col-2 d-flex justify-content-center align-items-center">
                                    <div class="quote-icon">
                                        <span>“</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('link', $post->ID)) {
                    $link_url = get_post_meta($post->ID, 'featured-link-url', true);
                    $link_text = get_post_meta($post->ID, 'featured-link-text', true);
                    $link_cite = get_post_meta($post->ID, 'featured-link-cite', true);
                    ?>
                    <div class="yhsshu-archive-post format-link">
                        <div class="format-wrap">
                            <div class="link-inner row">
                                <div class="inner-left col-10">
                                    <div class="link-text">
                                        <a target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                                    </div>
                                    <div class="yhsshu-divider"></div>
                                    <?php if (!empty($link_cite)) : ?>
                                        <p class="link-cite">
                                            <?php echo esc_attr($link_cite); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="inner-right col-2 d-flex justify-content-center align-items-center">
                                    <div class="link-icon">
                                        <a href="<?php echo esc_url($link_url); ?>"><span class="yhsshui-link"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                    $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                    if (isset($thumbnail)) {
                        ?>
                        <div class="item-featured">
                            <div class="post-image">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                                <?php
                                if ($show_date == 'true') : ?>
                                    <div class="post-date">
                                        <div class="post-day">
                                            <?php echo get_the_date('d', $post->ID); ?>
                                        </div>
                                        <div class="post-month-year">
                                            <?php echo get_the_date('M y', $post->ID); ?>
                                        </div>
                                    </div>
                                <?php endif;
                                if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                                    <div class="yhsshu-media-popup featured-video">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                                <i class="yhsshui-play-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;
                                if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                                    $filetype = wp_check_filetype($audio_url)['type'];
                                if ($filetype == 'audio/mpeg') : ?>
                                    <div class="yhsshu-media-popup featured-audio">
                                        <div class="content-inner">
                                            <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                                <i class="yhsshui-volume"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="item-content row">
                    <div class="item-left col-md-7 col-xl-8">
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
                        <?php if ($show_excerpt == 'true') : ?>
                            <div class="yhsshu-divider"></div>
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
                            <?php if ($show_button == 'true') : ?>
                                <div class="item-readmore yhsshu-button-wrapper">
                                    <a class="btn-more style-2" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                                        <i class="zmdi zmdi-long-arrow-right"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="item-right col-md-5 col-xl-4">
                        <?php
                        if ($show_author == 'true' || $show_comment == 'true') {
                            ?>
                            <div class="post-metas">
                                <div class="meta-inner">
                                    <?php if ($show_author == 'true') : ?>
                                        <span class="post-author">
                                            <span class="label"><?php echo esc_html__('Written By', 'yhsshu'); ?>&nbsp;<a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a></span>
                                        </span>
                                    <?php endif; ?>
                                    <?php
                                    $posttags = get_the_tags($post->ID);
                                    ?>
                                    <span class="post-tags">
                                        <span class="label"><?php echo esc_html('TAGS:', 'yhsshu'); ?></span>
                                        <?php if ($posttags) {
                                            foreach ($posttags as $tag) {
                                                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                            }
                                        }; ?>
                                    </span>
                                    <?php if ($show_comment == 'true') : ?>
                                        <span class="post-comments">
                                            <span class="label"><?php echo esc_html('COMMENTS:', 'yhsshu'); ?></span>
                                            <a href="<?php echo get_comments_link($post->ID); ?>">
                                                <span><?php comments_number(esc_html__('No Comments', 'yhsshu'), esc_html__(' 1 Comment', 'yhsshu'), esc_html__(' % Comments', 'yhsshu'), $post->ID); ?></span>
                                            </a>
                                        </span>
                                    <?php endif; ?>
                                    <?php ?>
                                    <span class="post-share">
                                        <span class="label"><?php echo esc_html('SHARE POST:', 'yhsshu'); ?></span>
                                        <?php yhsshu()->blog->get_post_share($post->ID); ?>
                                    </span>
                                    <?php ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
endforeach;
}

function yhsshu_get_post_list_layout4($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
            $img_id = get_post_thumbnail_id($post->ID);
            if ($img_id) {
                $img = yhsshu_get_image_by_size(array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            } else {
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Continue reading', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                if (has_post_format('quote', $post->ID)) {
                    $quote_text = get_post_meta($post->ID, 'featured-quote-text', true);
                    $quote_cite = get_post_meta($post->ID, 'featured-quote-cite', true);
                    ?>
                    <div class="format-quote">
                        <div class="format-wrap">
                            <div class="quote-inner">
                                <div class="quote-icon">
                                    <span>“</span>
                                </div>
                                <div class="quote-text">
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($quote_text); ?></a>
                                </div>
                                <div class="yhsshu-divider"></div>
                                <?php
                                if (!empty($quote_cite)) {
                                    ?>
                                    <p class="quote-cite">
                                        <?php echo esc_html($quote_cite); ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('link', $post->ID)) {
                    $link_url = get_post_meta($post->ID, 'featured-link-url', true);
                    $link_text = get_post_meta($post->ID, 'featured-link-text', true);
                    $link_cite = get_post_meta($post->ID, 'featured-link-cite', true);
                    ?>
                    <div class="format-link">
                        <div class="format-wrap">
                            <div class="link-inner">
                                <div class="link-icon">
                                    <a target="_blank" href="<?php echo esc_url($link_url); ?>"><span class="yhsshui-link"></span></a>
                                </div>
                                <a class="link-text" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a>
                                <?php if (!empty($link_cite)) : ?>
                                    <div class="yhsshu-divider"></div>
                                    <p class="link-cite">
                                        <?php echo esc_attr($link_cite); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } elseif (has_post_format('video', $post->ID)) {
                    $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                    if (isset($thumbnail)) {
                        ?>
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            <?php
                            if (!empty($featured_video)) { ?>
                                <div class="yhsshu-media-popup">
                                    <div class="content-inner">
                                        <a class="media-play-button media-default" href="<?php echo esc_url($featured_video); ?>">
                                            <i class="yhsshui-play-2 yhsshu-icon-outline"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                        <?php
                    }
                } elseif (has_post_format('audio', $post->ID)) {
                    $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                    if (isset($thumbnail)) { ?>
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        <?php }
                        if (!empty($audio_url)) {
                            $filetype = wp_check_filetype($audio_url)['type'];
                            if ($filetype == 'audio/mpeg') { ?>
                                <div class="yhsshu-media-popup">
                                    <div class="content-inner">
                                        <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                            <i class="yhsshui-volume"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            global $wp_embed;
                            yhsshu_print_html($wp_embed->run_shortcode('[embed]' . $audio_url . '[/embed]'));
                        } ?>
                    </div>
                    <?php
                } elseif (isset($thumbnail)) { ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                if (!has_post_format('link', $post->ID) && !has_post_format('quote', $post->ID)) {
                    ?>
                    <div class="item-content">
                        <?php
                        if ($show_author == 'true' || $show_date == 'true') {
                            ?>
                            <div class="post-metas">
                                <div class="meta-inner d-flex align-items-center">
                                    <div class="author-date-wrapper d-flex">
                                        <?php if ($show_author) : ?>
                                            <span class="post-author col-auto d-flex">
                                                <span><?php echo esc_html__('Written by', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($show_date && $show_author) : ?>
                                            <span><?php echo '&nbsp;-&nbsp;'; ?></span>
                                        <?php endif ?>
                                        <?php if ($show_date) : ?>
                                            <span class="post-date">
                                                <?php echo get_the_date(get_option('date_format'), $post->ID) . esc_html(' at ', 'yhsshu') . get_the_time(get_option('time_format'), $post->ID); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    $posttags = get_the_tags($post->ID);
                                    if ($posttags) : ?>
                                        <span class="post-tags">
                                            <span class="label"><?php echo esc_html('Tags: ', 'yhsshu'); ?></span>
                                            <?php if ($posttags) {
                                                $last_key = array_key_last($posttags);
                                                foreach ($posttags as $key => $tag) {
                                                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                                    if ($key != $last_key) {
                                                        echo ', ';
                                                    }
                                                }
                                            }; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
                        <?php if ($show_excerpt == 'true') : ?>
                            <div class="yhsshu-divider"></div>
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
                            <?php if ($show_button == 'true') : ?>
                                <div class="item-readmore yhsshu-button-wrapper">
                                    <a class="btn-more style-2" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                                        <i class="zmdi zmdi-long-arrow-right"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    endforeach;
}


function yhsshu_get_post_grid_layout1($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;

        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
               
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                    
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                if (isset($thumbnail)) :
                    ?>
                    <div class="item-featured">
                        <?php
                        if ($show_date == 'true') : ?>
                            <div class="post-date">
                                <div class="post-day">
                                    <?php echo get_the_date('d', $post->ID); ?>
                                </div>
                                <div class="post-month-year">
                                    <?php echo get_the_date('M y', $post->ID); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-image scale-hover">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                           
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <?php if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                            <div class="yhsshu-media-popup">
                                <div class="content-inner">
                                    <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                        <i class="yhsshui-play-2"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif;
                        if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                            $filetype = wp_check_filetype($audio_url)['type'];
                        if ($filetype == 'audio/mpeg') : ?>
                            <div class="yhsshu-media-popup featured-audio">
                                <div class="content-inner">
                                    <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                        <i class="zmdi zmdi-volume-up"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif; ?>
                    <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
                </div>
            </div>
        <?php endif; ?>
        <div class="item-content">
            <?php if ($show_category == 'true' || $show_author == 'true') : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($show_author == 'true') : ?>
                            <span class="post-author">
                                <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php if ($show_category == 'true') : ?>
                            <span class="post-category">
                                <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($show_divider == 'true') : ?>
                <div class="yhsshu-divider"></div>
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
                <div class="item-readmore yhsshu-button-wrapper">
                    <a class="btn-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                        <i class="zmdi zmdi-long-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
endforeach;
}

function yhsshu_get_post_grid_layout2($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                        <?php if ($show_category == 'true' || $show_date == 'true') : ?>
                            <div class="post-metas hover-underline">
                                <div class="meta-inner d-flex">
                                    <?php
                                    if ($show_date == 'true') : ?>
                                        <div class="post-date d-flex align-items-center">
                                            <i class="yhsshui yhsshui-calendar-days"></i>
                                            <?php echo get_the_date(get_option('date_format'), $post->ID); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $posttags = get_the_tags($post->ID);
                                    if ($posttags && $show_category == 'true') : ?>
                                        <div class="post-tags d-flex align-items-center">
                                            <i class="yhsshui yhsshui-tag1"></i>
                                            <?php
                                            $last_key = array_key_last($posttags);
                                            foreach ($posttags as $key => $tag) {
                                                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                                if ($key != $last_key) {
                                                    echo ', ';
                                                }
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="item-content d-flex justify-content-center">
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
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
                        <div class="item-readmore yhsshu-button-wrapper">
                            <a class="btn btn-additional-6" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <span><?php echo yhsshu_print_html($button_text); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_layout3($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <?php if ($show_category == 'true' || $show_author == 'true' || $show_date == 'true') : ?>
                        <div class="post-metas hover-underline">
                            <div class="meta-inner d-flex">
                                <?php if ($show_author == 'true') : ?>
                                    <span class="post-author">
                                        <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                    </span>
                                <?php endif; ?>
                                <?php
                                if ($show_date == 'true') : ?>
                                    <span class="post-date d-flex align-items-center">
                                        <?php echo get_the_date(get_option('date_format'), $post->ID); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($show_category == 'true') : ?>
                                    <span class="post-category">
                                        <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
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
                        <div class="item-readmore yhsshu-button-wrapper">
                            <a class="btn-more style-3" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <span><?php echo yhsshu_print_html($button_text); ?></span>
                                <i class="yhsshui yhsshui-arrow-right-solid"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_layout4($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image scale-hover-x-right">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                        <?php if ( $show_date == 'true') : ?>
                            <?php
                            if ($show_date == 'true') : ?>
                               <div class="post-date d-flex align-items-center">
                                    <div class="box-day"> 
                                        <?php echo get_the_date('d', $post->ID);?>
                                    </div>
                                    <div class="month-year">
                                        <div class="date-month"> 
                                            <?php echo get_the_date('M', $post->ID);?>
                                        </div>
                                        <div class="date-year"> 
                                            <?php echo get_the_date('y', $post->ID);?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <?php if ($show_category == 'true' || $show_author == 'true') : ?>
                        <div class="post-metas hover-underline">
                            <div class="meta-inner d-flex">
                                <?php if ($show_author == 'true') : ?>
                                    <span class="post-author">
                                        <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                    </span>
                                <?php endif; ?>
                                <?php if ($show_category == 'true') : ?>
                                    <span class="post-category">
                                        <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
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
                        <div class="item-readmore yhsshu-button-wrapper">
                            <a class="btn-more style-3" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <span><?php echo yhsshu_print_html($button_text); ?></span>
                                <i class="yhsshui yhsshui-angle-right1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    endforeach;
}

function yhsshu_get_post_grid_layout5($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                if (isset($thumbnail)) :
                    ?>
                    <div class="item-featured">
                        <?php
                        if ($show_date == 'true') : ?>
                            <div class="post-date">
                                <div class="post-day">
                                    <?php echo get_the_date('d', $post->ID); ?>
                                </div>
                                <div class="post-month-year">
                                    <?php echo get_the_date('M', $post->ID); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <?php if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                            <div class="yhsshu-media-popup">
                                <div class="content-inner">
                                    <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                        <i class="yhsshui-play-2"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif;
                        if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                            $filetype = wp_check_filetype($audio_url)['type'];
                        if ($filetype == 'audio/mpeg') : ?>
                            <div class="yhsshu-media-popup featured-audio">
                                <div class="content-inner">
                                    <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                        <i class="zmdi zmdi-volume-up"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="item-content">
            <?php if ($show_category == 'true' || $show_author == 'true') : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($show_author == 'true') : ?>
                            <span class="post-author">
                                <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php if ($show_category == 'true') : ?>
                            <span class="post-category">
                                <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
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
            <?php if ($show_divider == 'true') : ?>
                <div class="yhsshu-divider"></div>
            <?php endif; ?>
            <?php if ($show_button == 'true') : ?>
                <div class="item-readmore yhsshu-button-wrapper">
                    <a class="btn-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                        <i class="zmdi zmdi-long-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
endforeach;
}

function yhsshu_get_post_grid_layout6($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <?php if ($show_category == 'true' || $show_author == 'true' || $show_date == 'true') : ?>
                        <div class="post-metas hover-underline">
                            <div class="meta-inner d-flex">
                                <?php if ($show_author == 'true') : ?>
                                    <span class="post-author">
                                        <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                    </span>
                                <?php endif; ?>
                                <?php if ($show_category == 'true') : ?>
                                    <span class="post-category">
                                        <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                                    </span>
                                <?php endif; ?>
                                <?php
                                if ($show_date == 'true') : ?>
                                    <span class="post-date d-flex align-items-center">
                                        <?php echo get_the_date(get_option('date_format'), $post->ID); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
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
                        <div class="item-readmore yhsshu-button-wrapper">
                            <a class="btn-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <span><?php echo yhsshu_print_html($button_text); ?></span>
                                <i class="zmdi zmdi-long-arrow-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_layout7($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php
                $featured_video = get_post_meta($post->ID, 'featured-video-url', true);
                $audio_url = get_post_meta($post->ID, 'featured-audio-url', true);
                if (isset($thumbnail)) :
                    ?>
                    <div class="item-featured">
                        <?php
                        if ($show_date == 'true') : ?>
                            <div class="post-date">
                                <div class="post-day">
                                    <?php echo get_the_date('d', $post->ID); ?>
                                </div>
                                <div class="post-month-year">
                                    <?php echo get_the_date('M y', $post->ID); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-image scale-hover">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                            <?php if (has_post_format('video', $post->ID) && !empty($featured_video)) : ?>
                            <div class="yhsshu-media-popup">
                                <div class="content-inner">
                                    <a class="media-play-button media-default style-2" href="<?php echo esc_url($featured_video); ?>">
                                        <i class="yhsshui-play-2"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif;
                        if (has_post_format('audio', $post->ID) && !empty($audio_url)) :
                            $filetype = wp_check_filetype($audio_url)['type'];
                        if ($filetype == 'audio/mpeg') : ?>
                            <div class="yhsshu-media-popup featured-audio">
                                <div class="content-inner">
                                    <a class="media-play-button media-default" href="<?php echo esc_url($audio_url); ?>">
                                        <i class="zmdi zmdi-volume-up"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="item-content">
            <?php if ($show_category == 'true' || $show_author == 'true') : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($show_author == 'true') : ?>
                            <span class="post-author">
                                <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                            </span>
                        <?php endif; ?>
                        <?php if ($show_category == 'true') : ?>
                            <span class="post-category">
                                <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
            <?php if ($show_divider == 'true') : ?>
                <div class="yhsshu-divider"></div>
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
                <div class="item-readmore yhsshu-button-wrapper">
                    <a class="btn-more" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                        <span><?php echo yhsshu_print_html($button_text); ?></span>
                        <i class="zmdi zmdi-long-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
endforeach;
}

function yhsshu_get_post_grid_layout9($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <?php
                        if ($show_date == 'true') : ?>
                            <div class="post-date">
                                <div class="post-day">
                                    <?php echo get_the_date('d', $post->ID); ?>
                                </div>
                                <div class="post-month-year">
                                    <?php echo get_the_date('M', $post->ID); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <?php if ($show_category == 'true' || $show_author == 'true' || $show_date == 'true') : ?>
                        <div class="post-metas hover-underline">
                            <div class="meta-inner d-flex">
                                <?php if ($show_author == 'true') : ?>
                                    <span class="post-author">
                                        <span class="label"><?php echo esc_html__('By', 'yhsshu'); ?></span>
                                        <a href="<?php echo esc_url(get_author_posts_url($post->post_author, $author->user_nicename)); ?>"><?php echo esc_html($author->display_name); ?></a>
                                    </span>
                                <?php endif; ?>
                                <?php if ($show_category == 'true') : ?>
                                    <span class="post-category">
                                        <span><?php the_terms($post->ID, 'category', '', ', ', ''); ?></span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
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
                    <?php if ($show_divider == 'true') : ?>
                        <div class="yhsshu-divider"></div>
                    <?php endif; ?>
                    <?php if ($show_button == 'true') : ?>
                        <div class="item-readmore yhsshu-button-wrapper">
                            <a class="btn-more style-1" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <span><?php echo yhsshu_print_html($button_text); ?></span>
                                <i class="zmdi zmdi-arrow-forward"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_yhsshu_portfolio_list_layout1($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }
        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $author = get_user_by('id', $post->post_author);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <div class="row gx-lg-50 align-items-lg-center">
                    <?php
                    if (isset($thumbnail)) {
                        ?>
                        <div class="item-featured col-lg-6">
                            <div class="post-image scale-hover">
                                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="item-content col-lg-6">
                        <?php
                        if ($show_tag == 'true') {
                            ?>
                            <div class="post-metas">
                                <div class="meta-inner d-flex align-items-center">
                                    <span class="post-tag">
                                        <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', ',&nbsp', ''); ?>
                                    </span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
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
                            <div class="item-readmore yhsshu-button-wrapper">
                                <a class="btn" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <span><?php echo yhsshu_print_html($button_text); ?></span>
                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio1($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
                        <?php
                        if ($show_category == 'true') {
                            ?>
                            <div class="item-tags">
                                <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', '&nbsp-&nbsp', ''); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <?php if ($show_divider == 'true') : ?>
                            <div class="yhsshu-divider"></div>
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
                                <a class="bt-more-plus" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <i class="zmdi zmdi-arrow-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio2($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
                        <?php
                        if ($show_category == 'true') {
                            ?>
                            <div class="item-tags">
                                <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', '&nbsp-&nbsp', ''); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php if ($show_divider == 'true') : ?>
                        <div class="yhsshu-divider"></div>
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
                                echo wp_trim_words($content, $num_words, '...');
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_button == 'true') : ?>
                        <div class="item-readmore">
                            <a class="bt-more-plus" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <i class="zmdi zmdi-arrow-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio3($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="background-overlay"></div>
                <div class="content-inner">
                    <h4 class="item-title">
                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                    </h4>
                    <?php
                    if ($show_category == 'true') {
                        ?>
                        <div class="item-tags">
                            <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', '&nbsp-&nbsp', ''); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php if ($show_divider == 'true') : ?>
                        <div class="yhsshu-divider"></div>
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
                            <a class="bt-more-plus" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <i class="zmdi zmdi-arrow-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio8($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
                        <?php
                        if ($show_category == 'true') {
                            ?>
                            <div class="item-category">
                                <?php the_terms($post->ID, 'yhsshu-portfolio-category', '', ', ', ''); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio9($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $button_text = !empty($button_text) ? $button_text : esc_html__('Read more', 'yhsshu');
        $custom_text = get_post_meta($post->ID, 'custom_text_portfolio',true);
        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <div class="portfo-cus-text"><?php echo esc_html($custom_text); ?></div>
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
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
                                <a class="yhsshu-buttonmore" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <span><?php echo yhsshu_print_html($button_text); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio10($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];
        $button_text = !empty($button_text) ? $button_text : esc_html__('read more', 'yhsshu');

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
                        <?php
                        if ($show_category == 'true') {
                            ?>
                            <div class="item-tags">
                                <?php the_terms($post->ID, 'yhsshu-portfolio-tag', '', ', ', ''); ?>
                            </div>
                            <?php
                        }
                        ?>
                        <?php if ($show_divider == 'true') : ?>
                            <div class="yhsshu-divider"></div>
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
                            <div class="item-buttom">
                                <a class="btn btn-outline-secondary-2" href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                    <span><?php echo yhsshu_print_html($button_text); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_get_post_grid_yhsshu_portfolio12($posts = [], $settings = [], $args_m = [])
{
    extract($settings);
    foreach ($posts as $key => $post) :
        $str_item_class = !empty($args_m[$key]['item_class']) ? $args_m[$key]['item_class'] : $item_class;
        if (!empty($args_m[$key]['thumbnail'])) {
            $thumbnail = wp_specialchars_decode($args_m[$key]['thumbnail'], ENT_QUOTES);
        } else {
            if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) {
                $img_id = get_post_thumbnail_id($post->ID);
                if ($img_id) {
                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $img_id,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } else {
                    $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
                }
            }
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = yhsshu_get_term_of_post_to_class($post->ID, array_unique($tax));

        $increase = $key + 1;
        $data_settings = '';
        $animate_cls = '';
        if (!empty($item_animation)) {
            $animate_cls = ' yhsshu-animate yhsshu-invisible animated-' . $item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => ((float)$item_animation_delay * $increase)
            ]);
            $data_settings = 'data-settings="' . esc_attr($data_animation) . '"';
        }
        if (!empty($args_m[$key]['anm_cls']))
            $animate_cls = $args_m[$key]['anm_cls'];

        if (!empty($args_m[$key]['data_setting']))
            $data_settings = $args_m[$key]['data_setting'];

        ?>
        <div class="<?php echo esc_attr($str_item_class . ' ' . $animate_cls . ' ' . $filter_class); ?>" <?php yhsshu_print_html($data_settings); ?>>
            <div class="grid-item-inner">
                <?php if (isset($thumbnail)) : ?>
                    <div class="item-featured">
                        <div class="post-image">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="item-content">
                    <div class="content-inner">
                        <h4 class="item-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                        </h4>
                        <?php
                        if ($show_category == 'true') {
                            ?>
                            <div class="item-category">
                                <?php the_terms($post->ID, 'yhsshu-portfolio-category', '', ' / ', ''); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
}

function yhsshu_arrow_template($settings = [], $arrow_icon_prev_cls = 'yhsshui yhsshui-arrow-prev', $arrow_icon_next_cls = 'yhsshui yhsshui-arrow-next') {
    ?>
    <div class="yhsshu-swiper-arrows <?php echo esc_attr($settings['arrows_style']); ?>">
        <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-prev <?php echo esc_attr($settings['arrow_prev_position']); ?>">
            <?php 
            if ( $settings['arrow_icon_previous']['value'] ) 
                \Elementor\Icons_Manager::render_icon( $settings['arrow_icon_previous'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-icon'], 'span' );
            else
                echo '<span class="yhsshu-icon ' . $arrow_icon_prev_cls . '"></span>';
            ?>
        </div>
        <div class="yhsshu-swiper-arrow yhsshu-swiper-arrow-next <?php echo esc_attr($settings['arrow_next_position']); ?>">
            <?php
            if ( $settings['arrow_icon_next']['value'] ) 
                \Elementor\Icons_Manager::render_icon( $settings['arrow_icon_next'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-icon'], 'span' );
            else
                echo '<span class="yhsshu-icon ' . $arrow_icon_next_cls . '"></span>';
            ?>
        </div>
    </div>
    <?php
}