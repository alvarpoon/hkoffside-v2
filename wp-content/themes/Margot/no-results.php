<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<?php if ( is_home() ) { ?>
<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'margot' ), admin_url( 'post-new.php' ) ); ?></p>

<?php } elseif ( is_search() ) { ?>

<p class="alert alert-warning alert-noresults"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'margot' ); ?></p>
<?php get_template_part( 'searchform' ); ?>

<?php } else { ?>

<p class="alert alert-warning"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'margot' ); ?></p>

<?php get_template_part( 'searchform' ); ?>

<?php } ?>