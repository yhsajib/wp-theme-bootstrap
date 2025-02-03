<?php
// Register Fancy Box Widget
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_single_navigation',
        'title'      => esc_html__( 'yhsshu Single Navigation', 'yhsshu' ),
        'icon'       => 'eicon-icon-box',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Styles', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__('Default', 'yhsshu' ),
                                'style-2' => esc_html__('Style 2', 'yhsshu' ),
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    yhsshu_get_class_widget_path()
);