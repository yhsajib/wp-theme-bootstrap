<?php 
defined( 'ABSPATH' ) or exit( -1 );

/**
 * Recent Posts widgets
 *
 */

if(!function_exists('Ysshu_Register_wp_widget')) return;
add_action( 'widgets_init', function(){
    Ysshu_Register_wp_widget( 'yhsshu_Recent_Posts_Widget' );
});

class yhsshu_Recent_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'yhsshu_recent_posts',
            esc_html__( '* yhsshu Recent Posts', 'yhsshu' ),
            array(
                'description' => esc_attr__( 'Shows your most recent posts.', 'yhsshu' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'     => '',
            'number'    => 3,
            'post_type' => 'post',
            'post_in'   => '',
            'layout'    => '1',
            'date_format'    => '',
        ) );

        $title = empty( $instance['title'] ) ? '' : $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        printf( '%s', $args['before_widget']);

        if(!empty($title)){
            printf( '%s %s %s', $args['before_title'] , $title , $args['after_title']);
        }

        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10){
            $number = 4;
        }
        $date_format = $instance['date_format'];
        $post_type = $instance['post_type'];
        $post_in   = $instance['post_in'];
        $layout    = $instance['layout'];
        $sticky = '';
        if($post_in == 'featured') {
            $sticky = get_option( 'sticky_posts' );
        }
        $r = new WP_Query( array(
            'post_type'           => $post_type,
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in'            => $sticky,
            'post__not_in'        => array(get_the_ID())
        ) );

        if ( $r->have_posts() )
        {
            echo '<div class="yhsshu-posts-list">';

            while ( $r->have_posts() )
            {
                $r->the_post();
                global $post;
                echo '<div class="yhsshu-post-item d-flex">';
                    if(has_post_thumbnail(get_the_ID())){
                        echo '<div class="yhsshu-post-img">';
                            echo '<a href="'.get_the_permalink().'">';
                                echo get_the_post_thumbnail(get_the_ID(), 'size-recent-post', ['alt' => get_the_title()]);
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '<div class="yhsshu-list-content col">';
                        printf(
                            '<h4 class="yhsshu-wg-post-title yhsshu-heading align-self-end"><a href="%1$s" title="%2$s">%3$s</a></h4>',
                            esc_url( get_permalink() ),
                            esc_attr( get_the_title() ),
                            get_the_title()
                        );
                        echo '<span class="post-info">';
                        echo the_author_posts_link();
                        echo ' - ';
                        echo '<span>' .get_the_date($date_format != '' ? $date_format : get_option( 'date_format' ), get_the_ID()). '</span>';
                    echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        wp_reset_postdata();
        printf('%s', $args['after_widget']);
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field( $new_instance['title'] );
        $instance['number']    = absint( $new_instance['number'] );
        $instance['post_type'] = $new_instance['post_type'];
        $instance['post_in']   = $new_instance['post_in'];
        $instance['layout']    = $new_instance['layout'];
        $instance['date_format']    = $new_instance['date_format'];
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => esc_html__( 'Recent Posts', 'yhsshu' ),
            'post_type'     => 'post',
            'post_in'       => 'recent',
            'layout'        => '1',
            'number'        => 4,
            'date_format'    => '',
        ) );

        $title     = $instance['title'] ? esc_attr( $instance['title'] ) : esc_html__( 'Recent Posts', 'yhsshu' );
        $number    = absint( $instance['number'] );
        $post_type = isset($instance['post_type']) ? esc_attr($instance['post_type']) : '';
        $post_in   = isset($instance['post_in']) ? esc_attr($instance['post_in']) : '';
        $layout    = isset($instance['layout']) ? esc_attr($instance['layout']) : '1';
        $date_format    = isset($instance['date_format']) ? esc_attr($instance['date_format']) : '1';

        $post_type_list = ['post','yhsshu-portfolio', 'yhsshu-service', 'yhsshu-food'];
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'yhsshu' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>"><?php esc_html_e( 'Date Format:', 'yhsshu' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_format' ) ); ?>" type="text" value="<?php echo esc_attr( $date_format ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('post_type')); ?>"><?php esc_html_e( 'Post Type', 'yhsshu' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_type') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_type') ); ?>">
            <?php 
                foreach ($post_type_list as $key => $value) {
                ?>
                    <option value="<?php echo esc_attr($key) ?>"<?php if( $post_type == $key ){ echo 'selected="selected"';} ?>><?php echo esc_html($value); ?></option>
                <?php
                }
            ?>
            </select>
        </p>
        <p><label for="<?php echo esc_url($this->get_field_id('post_in')); ?>"><?php esc_html_e( 'Post in', 'yhsshu' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_in') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_in') ); ?>">
            <option value="recent"<?php if( $post_in == 'recent' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent', 'yhsshu'); ?></option>
            <option value="featured"<?php if( $post_in == 'featured' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Featured', 'yhsshu'); ?></option>
         </select>
         </p>
          <p><label for="<?php echo esc_url($this->get_field_id('layout')); ?>"><?php esc_html_e( 'Layout', 'yhsshu' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
            <option value="1"<?php if( $layout == '1' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'yhsshu'); ?></option>
         </select>
         </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'yhsshu' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>

        <?php
    }
}
