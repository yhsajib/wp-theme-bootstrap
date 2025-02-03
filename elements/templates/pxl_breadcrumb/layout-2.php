<?php
if (!class_exists('yhsshu_Breadcrumb')) return;
 
$breadcrumb = new yhsshu_Breadcrumb();
$entries = $breadcrumb->get_entries();

$brc_divider = '<span class="br-divider"></span>';
?>
<div class="yhsshu-breadcrumb hover-underline layout-2">
    <?php
    foreach ( $entries as $entry ){
        $entry = wp_parse_args( $entry, array(
            'label' => '',
            'url'   => ''
        ) );

        if ( empty( $entry['label'] ) ){
            continue;
        }

        echo '<div class="br-item">';
        if ( ! empty( $entry['url'] ) ){
            printf(
                '<a class="br-link" href="%1$s">%2$s</a>%3$s',
                esc_url( $entry['url'] ),
                esc_attr( $entry['label'] ),
                $brc_divider
            );
        }else{
            printf( '<span class="br-text" >%s</span>%2$s', $entry['label'], $brc_divider );
        }
        echo '</div>';
    }
    ?>
</div>