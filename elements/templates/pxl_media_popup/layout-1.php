<div class="yhsshu-media-popup">
    <div class="media-content-inner">
        <a class="media-play-button <?php echo esc_attr($settings['icon_style']); ?> <?php echo esc_attr($settings['media_type']); ?>"
        href="<?php echo esc_url($settings['media_link']['url']);?>">
            <?php if ($settings['media_style'] == 'featured-video') : ?>
                <i class="yhsshui-play-2"></i>
            <?php elseif ($settings['media_style'] == 'featured-audio') :?>
                <i class="yhsshui-volume"></i>
            <?php endif; ?>
        </a>
        <?php if (!empty($settings['description_text'])) : ?>
            <p class="button-text"><?php yhsshu_print_html(nl2br($settings['description_text'])); ?></p>
        <?php endif; ?>
    </div>
</div>