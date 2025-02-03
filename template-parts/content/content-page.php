<?php
/**
 * @package yhsshu
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="yhsshu-entry-content clearfix">
        <?php
            the_content();
            yhsshu()->page->get_link_pages();
        ?>
    </div> 
</article> 
