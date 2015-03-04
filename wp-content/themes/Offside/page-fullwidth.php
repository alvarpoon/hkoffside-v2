 <?php
/**
 * @package margot
 * @since margot 1.0
 * Template Name: Full-Width
 */
get_header(); ?>

<div class="container container-page-content">
	<div id="mrg-wrap" class="omega">
		<div class="row">

			<?php if (have_posts()) :
			while (have_posts()) : the_post(); margot_setPostViews(get_the_ID()); 

			get_template_part( 'content', 'page' );

			endwhile; endif; wp_reset_query();

			?>
		
		</div>
	</div>
</div>

<?php get_footer(); ?>