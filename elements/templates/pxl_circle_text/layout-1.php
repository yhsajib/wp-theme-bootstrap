<?php
use Elementor\Utils;
?>
<div class="yhsshu-circle-text layout-1">
    <?php if(!empty($widget->get_setting('title'))): ?>
        <div id="circle-text" class="circle-text">
            <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
        </div>
    <?php endif; ?>
</div>