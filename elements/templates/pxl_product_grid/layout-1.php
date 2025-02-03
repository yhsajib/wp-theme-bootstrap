<?php
$wg_id = $settings['element_name'] . '-' . $settings['element_id'];
$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');

$param_args=[];
$loop = yhsshu_Woo_Query::instance()->yhsshu_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
extract($loop);
$pagination_type      = $widget->get_setting('pagination_type', 'false');

$row_cols_class = yhsshu_get_shop_loop_row_column_class([
    'col_xs'  => $widget->get_setting('col_xs', '1'),
    'col_sm'  => $widget->get_setting('col_sm', '2'),
    'col_md'  => $widget->get_setting('col_md', '2'),
    'col_lg'  => $widget->get_setting('col_lg', '3'),
    'col_xl'  => $widget->get_setting('col_xl', '4'),
    'col_xxl' => $widget->get_setting('col_xxl', '4')
]);
$grid_class = 'yhsshu-grid-inner products row relative '.implode(' ', $row_cols_class);
$widget->add_render_attribute( 'grid', 'class', $grid_class);
if( $total <= 0){
    echo '<div class="yhsshu-no-post-grid">'.esc_html__( 'No Post Found', 'yhsshu' ). '</div>';
    return;
}

$product_layout = $widget->get_setting('product_layout', 'layout-1');
?>

<div id="<?php echo esc_attr($wg_id) ?>" class="yhsshu-product-grid <?php echo 'yhsshu-shop-'.esc_attr($product_layout); ?>">
    <div <?php yhsshu_print_html($widget->get_render_attribute_string('grid')); ?>>
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            wc_get_template_part( 'yhsshu-content-product', esc_attr($product_layout) );
        }
        ?>
        <?php wp_reset_postdata(); ?>
    </div>

    <?php if ($pagination_type == 'pagination' || $pagination_type == 'loadmore' || $pagination_type == 'infinite' ) { ?>
        <div class="yhsshu-product-grid-pagination grid-df-pagin d-flex justify-content-center">
            <?php
            if ( empty( $query ) ){
                $query = $GLOBALS['wp_query'];
            }
            if ( !empty( $query->max_num_pages ) && is_numeric( $query->max_num_pages ) && $query->max_num_pages >= 2 ){
                $paged = $query->get( 'paged', '' );

                if ( ! $paged && is_front_page() && ! is_home() )
                {
                    $paged = $query->get( 'page', '' );
                }

                $paged = $paged ? intval( $paged ) : 1;
                $pagin_args = array(
                    'total'           => $query->max_num_pages,
                    'current'         => $paged,
                    'base'            => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
                    'format'          => '?product-page=%#%',
                    'pagination_type' => $pagination_type,
                    'limit'           => $post_per_page,
                    'loadmore_text'   => $settings['loadmore_text'],
                    'class'           => 'el-widget',
                    'total_posts'     => $total
                );
                wc_get_template( 'loop/pagination-custom.php', $pagin_args );
            }
            ?>
        </div>
    <?php } ?>
</div>