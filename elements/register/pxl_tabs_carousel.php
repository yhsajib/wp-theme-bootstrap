<?php
$templates = yhsshu_get_templates_option('default', []) ;
yhsshu_add_custom_widget(
    array(
        'name' => 'yhsshu_tabs_carousel',
        'title' => esc_html__('yhsshu Tabs Carousel', 'yhsshu'),
        'icon' => 'eicon-slider-push',
        'categories' => array('yhsshutheme-core'),
        'scripts' => [
            'yhsshu-tabs-carousel',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'yhsshu'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'link_to_tabs',
                            'label' => esc_html__('ID Link To Tabs', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                        ),
                        array(
                            'name' => 'tabs_list_carousel',
                            'label' => esc_html__('Tabs List', 'yhsshu'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'content_type',
                                    'label' => esc_html__('Content Type', 'yhsshu'),
                                    'type' => Elementor\Controls_Manager::SELECT,
                                    'options' => [
                                        'df' => esc_html__( 'Default', 'yhsshu' ),
                                        'template' => esc_html__( 'From Template Builder', 'yhsshu' )
                                    ],
                                    'default' => 'df'
                                ),
                                array(
                                    'name' => 'content_template',
                                    'label' => esc_html__('Select Templates', 'yhsshu'),
                                    'description' => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','yhsshu'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=yhsshu-template' ) ) . '">','</a>'),
                                    'type' => Elementor\Controls_Manager::SELECT,
                                    'options' => $templates,
                                    'default' => 'df',
                                    'condition' => ['content_type' => 'template'] 
                                ),
                                array(
                                    'name' => 'tab_content_carousel',
                                    'label' => esc_html__('Enter Content', 'yhsshu'),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => '',
                                    'condition' => ['content_type' => 'df'] 
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'fade',
                                'label' => esc_html__('Fade Effect', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => 'false',
                            ),
                            array(
                                'name' => 'swipe',
                                'label' => esc_html__('Allow Swipe', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => 'true',
                            ),
                            array(
                                'name' => 'autoplay',
                                'label' => esc_html__('Autoplay', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => 'false',
                            ),
                            array(
                                'name' => 'infinite',
                                'label' => esc_html__('Infinite', 'yhsshu'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => 'false',
                            )
                        ),
                    ),
                ),
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_arrow_settings(),
                    ),
                ),
                array(
                    'name' => 'dots_settings',
                    'label' => esc_html__('Dot Settings', 'yhsshu' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        yhsshu_dots_settings(),
                    ),
                ),
            ),
        ),
    ),
    yhsshu_get_class_widget_path()
);