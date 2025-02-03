<?php
global $wp_registered_sidebars;
$options = [];

if ( ! $wp_registered_sidebars ) {
    $options[''] = esc_html__( 'No sidebars were found', 'yhsshu' );
} else {
    $options[''] = esc_html__( 'Choose Sidebar', 'yhsshu' );

    foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
        $options[ $sidebar_id ] = $sidebar['name'];
    }
}

$default_key = array_keys( $options );
$default_key = array_shift( $default_key );

yhsshu_add_custom_widget(
    array(
        'name'       => 'yhsshu_sidebar',
        'title'      => esc_html__( 'yhsshu Sidebar', 'yhsshu' ),
        'icon' => 'eicon-nav-menu',
        'categories' => array('yhsshutheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'yhsshu' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'sidebar',
                            'label' => esc_html__( 'Choose Sidebar', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => $default_key,
                            'options' => $options,
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__( 'Style', 'yhsshu' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-df' => esc_html__('Default', 'yhsshu'),
                                'style-2' => esc_html__('Style 2', 'yhsshu'),
                                'style-3' => esc_html__('Style 3', 'yhsshu'),
                                'style-4' => esc_html__('Style 4', 'yhsshu'),
                            ],
                            'default' => 'style-df'
                        )
                    ),
                )
            )
        )
    ),
    yhsshu_get_class_widget_path()
);