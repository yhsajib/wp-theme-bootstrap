<?php
yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_testimonial_single',
        'title'      => esc_html__( 'yhsshu Client Review', 'yhsshu' ),
        'icon' => 'eicon-editor-quote',
        'categories' => array('yhsshutheme-core'),
        'scripts'    => array(
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'yhsshu' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/yhsshu_testimonial_single-1.jpg'
                                ],
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'review_section',
                    'label' => esc_html__( 'How To Create Review Link?', 'yhsshu' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'review_guide',
                            'label' => esc_html__( 'Review Link Format:', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'description' => esc_html__('https://search.google.com/local/writereview?placeid=YOUR_PLACE_ID', 'yhsshu'),

                        ),
                        array(
                            'name' => 'review_placeid',
                            'label' => esc_html__( 'Get YOUR_PLACE_ID At:', 'yhsshu' ),
                            'type'    => 'layoutcontrol',
                            'description' => esc_html__('https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/places-placeid-finder', 'yhsshu'),

                        ),
                    ),
                ),
                array(
                    'name' => 'section_clients',
                    'label' => esc_html__('Clients', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'yhsshu' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'yhsshui',
                                'value'   => 'yhsshui-quote'
                            ],
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'yhsshu' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .yhsshu-testimonial-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .yhsshu-testimonial-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'tt_content',
                            'label' => __( 'Content', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'rows' => '10',
                            'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                            'placeholder' => esc_html__('Enter some text here.', 'yhsshu' ),
                        ),
                        array(
                            'name' => 'tt_description',
                            'label' => esc_html__('Description', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'rows' => '3',
                            'label_block' => true,
                            'default' => esc_html__( 'John Doe', 'yhsshu' )
                        ),
                        array(
                            'name' => 'rating',
                            'label' => esc_html__('Rating', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => esc_html__('None', 'yhsshu' ),
                                'star1' => esc_html__('1 Star', 'yhsshu' ),
                                'star2' => esc_html__('2 Star', 'yhsshu' ),
                                'star3' => esc_html__('3 Star', 'yhsshu' ),
                                'star4' => esc_html__('4 Star', 'yhsshu' ),
                                'star5' => esc_html__('5 Star', 'yhsshu' ),
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);