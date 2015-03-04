<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<div class="logo-section col-md-4">
	<?php if(of_get_option('logo_uploader_footer', false)) : ?>
		<h2 class="logo-footer-img"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php margot_custom_logo('footer'); ?></a></h2>
	<?php else: ?>
		<h2 class="logo-footer"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
	<?php endif; ?>

	<p class="site-description"><?php echo of_get_option('footer_description'); ?></p>

	<?php dynamic_sidebar( 'footer-1' ); ?>

	<div class="unroll"><p class="copy"><?php echo of_get_option('footer_tag'); ?></p></div>
</div> <hr class="border-push col-md-push-4 visible-md visible-lg" /> <!-- /col-1 -->
 

<?php if (is_active_sidebar('footer-2') ) : ?>
<div class="col-md-4">
	<?php dynamic_sidebar( 'footer-2' ); ?>
</div> <hr class="border-push col-md-push-8 visible-md visible-lg" /> <!-- /col-2 -->
<?php endif; ?>


<?php if (is_active_sidebar('footer-3') ) : ?>
<div class="col-md-4">
	<?php dynamic_sidebar( 'footer-3' ); ?>
</div> <!-- /col-3 -->
<?php endif; ?>