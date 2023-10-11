<?php
/**
 * Title: Post Meta
 * Slug: poisk/post-meta
 * Categories: query
 * Keywords: post meta
 * Block Types: core/template-part/post-meta
 */
?>

<!-- wp:group {"layout":{"type":"flex"}} -->
<div class="wp-block-group">
    <!-- wp:post-date /-->

    <!-- wp:paragraph -->
    <p>
        <?php echo esc_html_x( 'in', 'Preposition to show the relationship between the post and its categories', 'twentytwentythree' ); ?>
    </p>
    <!-- /wp:paragraph -->

    <!-- wp:post-terms {"term":"category"} /-->
</div>
<!-- /wp:group -->
