<?php
$time_to = $settings['time_to'];
?>
<div class="yhsshu-countdown layout-2">
    <div class="yhsshu-countdown-container font-smooth" data-time="<?php echo esc_attr($time_to); ?>">
        <div class="time-item">
            <div class="time-item-inner">
                <div class="day inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Days', 'yhsshu') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="hour inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Hours', 'yhsshu') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="minute inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Minutes', 'yhsshu') ?></div>
            </div>
        </div>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="second inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Seconds', 'yhsshu') ?></div>
            </div>
        </div>
    </div>
</div>