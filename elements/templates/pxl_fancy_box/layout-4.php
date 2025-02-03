<?php
use Elementor\Utils;
?>

<div class="yhsshu-fancy-box layout-4">
    <div class="box-inner box-inner overflow-hidden d-flex flex-column align-items-center">
        <div class="box-icon">
            <?php if(! empty( $settings['selected_icon']['value'] )): ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'yhsshu-fancy-icon yhsshu-icon' ], 'i' );?>
            <?php endif; ?>
        </div> 
        <div class="box-content">
            <?php if(!empty($widget->get_setting('title'))): ?>
                <h3 class="box-title">
                    <?php yhsshu_print_html( nl2br($widget->get_setting('title'))); ?>
                </h3>
                <div class="yhsshu-divider"></div>
            <?php endif; ?>
            <?php if(!empty($widget->get_setting('description'))): ?>
                <div class="box-description">
                    <?php yhsshu_print_html($widget->get_setting('description')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>  
</div>