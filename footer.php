<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Poisk
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer-first">
		    <div class="site-main">
		        <?php dynamic_sidebar( 'footer-left' ); ?>
		    </div>
		</div>
		<div class="site-footer-second">
		    <div class="site-main">
                <?php bloginfo('name') ?>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
