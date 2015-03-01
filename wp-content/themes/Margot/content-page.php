<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="mrg-page-header">
		<div class="untop">
			<div id="mrg-featured-media">
			<?php margot_post_head(); ?>
			</div>
		</div>

		<div class="mrg-head-title">
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php single_post_title(); ?> </a></h2>
		</div>
	</header>

	<div id="mrg-content" class="mrg-post-inner <?php echo margot_custom_class(); ?>">

		<div class="entry-content">
			<?php the_content(); ?>
			<?php $args = array('before'=> '<p class="dphpost-pages"><span class="pgopen">' . __('Pages:', 'margot') .'','after'=> '</p>','link_before'=> '','link_after'=> '','next_or_number'=> 'number','pagelink'=> '<span>%</span>','echo'=> 1); wp_link_pages( $args ); ?>
			<?php edit_post_link( __( 'Edit', 'margot' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

		<div class="wave"></div> <div class="unroll"><hr class="mrg-sep" /></div>

	</div>

</article>