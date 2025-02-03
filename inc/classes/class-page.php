<?php
if (!class_exists('yhsshu_Page')) {
    class yhsshu_Page
    {
        public function get_site_loader(){

            $site_loader = yhsshu()->get_theme_opt( 'site_loader', false );
            $site_loader_style = yhsshu()->get_theme_opt('site_loader_style', 'default');
            $loader_image = yhsshu()->get_theme_opt( 'loader_image', array( 'url' => '', 'id' => '' ) );

            if ($site_loader){
                switch ( $site_loader_style ) {
                    case 'gif_image': ?>
                        <div id="yhsshu-loadding" class="yhsshu-loader content-image">
                            <?php
                            $static_img_extensions = ['jpg', 'jpeg', 'bmp', 'png'];
                            $img_extension = strtolower(pathinfo($loader_image['url'], PATHINFO_EXTENSION));
                            if(!empty($loader_image['url'])) { ?>
                                <img src="<?php echo esc_url($loader_image['url']);?>" <?php echo in_array($img_extension, $static_img_extensions) ? 'class="static-img-loading"' : ''; ?>>
                            <?php }
                            ?>
                        </div>
                        <?php break;
                    default: ?>
                        <div id="yhsshu-loadding" class="yhsshu-loader default">
                            <div class="loader_line"></div>
                        </div>
                        <?php break;
                }
            }
        }

        public function get_link_pages() {
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) ); 
        }

        public function get_pagination( $query = null, $ajax = false ){

            if($ajax){
                add_filter('paginate_links', 'yhsshu_ajax_paginate_links');
            }

            $classes = array();

            if ( empty( $query ) )
            {
                $query = $GLOBALS['wp_query'];
            }

            if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
            {
                return;
            }

            $paged = $query->get( 'paged', '' );

            if ( ! $paged && is_front_page() && ! is_home() )
            {
                $paged = $query->get( 'page', '' );
            }

            $paged = $paged ? intval( $paged ) : 1;

            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = array();
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[1] ) )
            {
                wp_parse_str( $url_parts[1], $query_args );
            }

            $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $html_prev = '<span class="yhsshui yhsshui-angle-double-left"></span>';
            $html_next = '<span class="yhsshui yhsshui-angle-double-right"></span>';
            $paginate_links_args = array(
                'base'     => $pagenum_link,
                'total'    => $query->max_num_pages,
                'current'  => $paged,
                'mid_size' => 1,
                'add_args' => array_map( 'urlencode', $query_args ),
                'prev_text' => $html_prev,
                'next_text' => $html_next,
            );
            if($ajax){
                $paginate_links_args['format'] = '?page=%#%';
            }
            $links = paginate_links( $paginate_links_args );

            $pagination_style = yhsshu()->get_theme_opt('archive_pagination_style', 'style-df');
            if ( $links ):
            ?>
            <nav class="posts-pagination <?php echo esc_attr($ajax?'ajax':'') ?> <?php echo esc_attr($pagination_style); ?>">
                <div class="pagination-inner">
                    <?php printf($links); ?>
                </div>
            </nav>
            <?php
            endif;
        }
    }
}
 