<?php
if (!class_exists('yhsshu_Page_Title')) return;
$titles = yhsshu()->pagetitle->get_title();
if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $titles['sub_title'] = "Subtitle will get from page settings";
}
?>
<div class="yhsshu-pt-wrap">
    <div class="sub-title">
        <?php yhsshu_print_html($titles['sub_title']) ?>
    </div>
</div>
