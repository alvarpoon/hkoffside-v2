<?php
/**
 * @package margot
 * @since margot 1.0
 */
get_header(); 
?>

<?php if( is_home() && !is_paged() && of_get_option( 'mrg_featured_area', true ) ) { 
	get_template_part( 'content-featured' );
 } ?>

 <?php if( is_home() && !is_paged() && of_get_option( 'mrg_carousel_posts', false ) ) { 
	get_template_part( 'content-media' );
 } ?>


<div class="container container-content">
	<div id="mrg-wrap" class="omega">
		<div class="row"> 

			<div id="mrg-content" class="col-md-8 col-feed">

				<div class="unroll"><h3 class="pretitle"><span><?php _e('Latest News', 'margot'); ?></span></h3></div>

				<div id="mrg-main-feed">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="extract">
							<?php get_template_part( 'content' ); ?>
						</div>

					<?php endwhile; endif; ?>
				</div> <!-- /mrg-posts -->
				<?php margot_content_nav(); ?>
			</div>

					<?php get_sidebar(); ?> 

			
		</div> <hr class="border-push col-md-push-8 visible-md visible-lg" />
	</div>
</div>

<?php
get_footer(); 
?>