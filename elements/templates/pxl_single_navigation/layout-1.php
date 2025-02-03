<?php        
if (!is_single()) return false;
?>

<div class="yhsshu-single-nav">
    <?php
    global $post;

    $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
    $next     = get_adjacent_post(false, '', false);

    if (!$next && !$previous)
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if (empty($previous_post) && empty($next_post)) return;
    ?>
    <div class="single-next-prev-nav row gx-0 justify-content-between align-items-center">
        <?php if (!empty($previous_post)) :
            $prev_img_id = get_post_thumbnail_id($previous_post->ID);
            $prev_img_url = wp_get_attachment_image_src($prev_img_id, 'thumbnail');

            $img = yhsshu_get_image_by_size(array(
                'attach_id'  => $prev_img_id,
                'thumb_size' => '108x108',
                'class' => 'no-lazyload',
            ));
            $thumbnail = $img['thumbnail'];
            ?>
            <div class="nav-next-prev prev col relative text-start">
                <div class="nav-inner">
                    <?php if ($thumbnail) : ?>
                        <div class="col-auto">
                            <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="col">
                        <?php previous_post_link('%link', ''); ?>
                        <div class="nav-label-wrap d-flex align-items-center">
                            <span class="nav-label"><?php echo esc_html__('Previous', 'yhsshu'); ?></span>
                        </div>
                        <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                            <div class="nav-title"><?php echo get_the_title($previous_post->ID); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="grid-archive">
            <a href="<?php echo get_post_type_archive_link('post'); ?>">
                <div class="nav-archive-button">
                    <div class="archive-btn-square square-1"></div>
                    <div class="archive-btn-square square-2"></div>
                    <div class="archive-btn-square square-3"></div>
                    <div class="archive-btn-square square-4"></div>
                </div>
            </a>
        </div>
        <?php if (!empty($next_post)) :
            $next_img_id = get_post_thumbnail_id($next_post->ID);
            $next_img_url = wp_get_attachment_image_src($next_img_id, 'thumbnail');

            $img = yhsshu_get_image_by_size(array(
                'attach_id'  => $next_img_id,
                'thumb_size' => '108x108',
                'class' => 'no-lazyload',
            ));
            $thumbnail = $img['thumbnail'];
            ?>
            <div class="nav-next-prev next col relative text-end">
                <div class="nav-inner">
                    <div class="col">
                        <?php next_post_link('%link', ''); ?>
                        <div class="nav-label-wrap d-flex align-items-center justify-content-end">
                            <span class="nav-label"><?php echo esc_html__('Next', 'yhsshu'); ?></span>
                        </div>
                        <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                            <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                        </div>
                    </div>
                    <?php if ($thumbnail) : ?>
                        <div class="col-auto">
                            <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>