<?php
/**
 * @package margot
 * @since margot 1.0
 */
get_header();

?>

<div class="container container-content">
	<div id="mrg-wrap" class="omega">
		<div class="row"> 

			<div id="mrg-content" class="col-md-8 col-feed">

				<div class="unroll"><h3 class="pretitle"><span><?php printf( __( 'Search Results for: %s', 'margot' ),  get_search_query() ); ?></span></h3></div>

				<div id="mrg-main-feed">

					<?php if (have_posts()): while (have_posts()): the_post(); ?>

					<div class="extract">
						<?php get_template_part('content'); ?>
					</div>

					<?php
						endwhile; else:
							get_template_part( 'no-results' );
						endif; wp_reset_query();
					?>

				</div> <!-- /mrg-main-feed -->

				<?php margot_content_nav(); ?>

			</div>

			<?php get_sidebar(); ?> 

		</div> <hr class="border-push col-md-push-8 visible-md visible-lg" />

	</div>
</div>


<?php
get_footer(); 
?>