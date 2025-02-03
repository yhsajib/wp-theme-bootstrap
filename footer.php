<?php
/**
 * @package yhsshu
 */
$custom_cursor 		= yhsshu()->get_theme_opt( 'custom_cursor', false );
$drag_cursor   		= yhsshu()->get_theme_opt( 'drag_cursor', false );
$drag_cursor_text   = yhsshu()->get_theme_opt( 'drag_cursor_text', 'Drag' );
?>
</div><!-- #main -->
<?php yhsshu()->footer->getFooter(); ?>
</div>
<?php //do_action('yhsshu_anchor_target') 
	yhsshu_action('anchor_target');
?>
<?php wp_footer(); ?>
<?php if ($custom_cursor) : ?>
	<div class="yhsshu-cursor"></div>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Select the `ul` element containing all items
    const ulElement = document.querySelector("ul.apbd-nmca-vt-cart-ul");

	document.querySelector(".apbd-nmca-vt-header-left-side-title").innerHTML = "Sushi yaki";

    if (ulElement) {
        // Get all `li` items within the `ul`
        const liElements = ulElement.querySelectorAll("li.apbd-nmca-vt-cart-product-list");

        // Loop through each `li` item
        liElements.forEach((liElement) => {
            // Select the elements to rearrange
            const itemNameContainer = liElement.querySelector(".apbd-nmca-vt-item-name");
            const itemProperties = liElement.querySelector(".apbd-nmca-vt-item-properties");
            const itemDescription = liElement.querySelector(".apbd-nmca-vt-item-description");

            if (itemNameContainer && itemProperties && itemDescription) {
                // Move the itemProperties into itemNameContainer
                itemNameContainer.appendChild(itemProperties);

                // Append itemNameContainer before itemDescription
                const itemContainer = liElement.querySelector(".apbd-nmca-vt-item-container");
                itemContainer.insertBefore(itemNameContainer, itemDescription);
            }
        });
    }
});


</script>
</body>
</html>
