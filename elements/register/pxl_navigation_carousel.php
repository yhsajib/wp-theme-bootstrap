<?php
// Register yhsshu Widget
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_navigation_carousel',
        'title' => esc_html__('Navigation Carousel', 'yhsshu' ),
        'icon' => 'eicon-dual-button',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Navigation Setting', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'carousel_ids',
                            'label' => esc_html__('Carousel Ids', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => esc_html__('List of CSS ID of carousel widget that navigation will affect, without #, separated by commas. Example: "id1, id2"', 'yhsshu'),
                        ),
                        array(
                            'name' => 'nav_style',
                            'label' => esc_html__('Navigation Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'default' => 'Default',
                            ],
                            'default' => 'default',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'prev_background',
                            'label' => esc_html__('Prev Button Background', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-navigation-carousel .nav-prev' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'prev_color',
                            'label' => esc_html__('Prev Button Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-navigation-carousel .nav-prev i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'next_background',
                            'label' => esc_html__('Next Button Background', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-navigation-carousel .nav-next' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'next_color',
                            'label' => esc_html__('Next Button Color', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-navigation-carousel .nav-next i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  =>  'button_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Button Size', 'yhsshu'),
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 30,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-navigation-carousel .nav-button' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                            ],

                        ),
                    )
                ),  
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);