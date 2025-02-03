<?php
/**
 * @package yhsshu
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="yhsshu-page" class="yhsshu-page">
        <div class="yhsshu-page-overlay"></div>
        <?php yhsshu()->page->get_site_loader(); ?>
        <?php yhsshu()->header->getHeader(); ?>
        <?php yhsshu()->pagetitle->get_page_title(); ?>
        <div id="yhsshu-main" class="yhsshu-main">
