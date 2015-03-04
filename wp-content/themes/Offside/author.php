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

				<div class="unroll"><div class="footer-meta author-cc">
                        <?php echo get_avatar( get_the_author_meta('ID'), 70 ); ?>
                        <h4><?php _e('About','margot') ?> <?php the_author(); ?></h4>
                        <span class="mini-author"><?php _e('has published', 'margot'); ?> <?php the_author_posts(); ?> <?php _e('posts', 'margot'); ?></span>
                        <span class="mini-icons hidden-xs"><?php margot_author_icons(); ?></span>
                        <p class="author-bio"><?php the_author_meta('description'); ?></p>
                </div>

				<h3 class="pretitle"><span><?php printf( __( 'Author Archives: %s', 'margot' ), '<a class="url vcard fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' ); ?></span></h3></div>

				<div id="mrg-main-feed">

					<?php if (have_posts()): while (have_posts()): the_post(); ?>

					<div class="extract">
						<?php get_template_part('content'); ?>
					</div>

					<?php endwhile; endif; ?>

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