<?php
if (!class_exists('yhsshu_Page_Title')) return;
$titles = yhsshu()->pagetitle->get_title();
$style = $widget->get_setting('style', 'style-1');
?>

<div class="yhsshu-pt-wrap <?php echo esc_attr($style); ?>">
    <h1 class="main-title">
        <span><?php yhsshu_print_html($titles['title']) ?></span>
    </h1>
</div>