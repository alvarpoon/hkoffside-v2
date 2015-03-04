 <?php
/**
 * @package margot
 * @since margot 1.0
 */
get_header(); ?>

<div class="container container-single-content">
	<div id="mrg-wrap" class="omega">
		<div class="row">

			<?php if (have_posts()) :
			while (have_posts()) : the_post(); margot_setPostViews(get_the_ID()); 

			get_template_part( 'content', 'single' );

			endwhile; endif; wp_reset_query();

			if (!get_post_meta($post->ID, 'margot_meta_sidebar', false)) { get_sidebar(); }
			?>
		
		</div> <hr class="border-push col-md-push-8 visible-md visible-lg" />

	</div>
</div>

<?php get_footer(); ?>