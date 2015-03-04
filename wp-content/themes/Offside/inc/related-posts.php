<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<?php
	$tags = wp_get_post_tags($post->ID);
	$categories = get_the_category( $post->ID );
	$first_cat = $categories[0]->cat_ID;
	if ($tags) {
		foreach($tags as $get_tag) $tag_ids[] = $get_tag->term_id;
	}

	$ykrelated_posts = new WP_Query( array(
		'posts_per_page' => '5',
		'tag__in' => $tags ? $tag_ids : 0,
		'category__in' => $tags ? 0 : array( $first_cat ),
		'post__not_in' => array($post->ID),
		)
	);

if ( $ykrelated_posts->have_posts() ) : ?>

	<div class="pretag icon-related"><?php _e('Related Stories', 'margot'); ?></div>
	<h3 class="presub"><?php _e('You May Like This', 'margot'); ?></h3>

	<div id="featured-related">
		<div class="sc-panels owl-carousel owl-theme">

			<?php while ( $ykrelated_posts->have_posts() ) : $ykrelated_posts->the_post(); ?>

			
			<div class="item">
				<a href="<?php the_permalink(); ?>"><div class="meta-info">
					<h2><?php the_title(); ?></h2>
				</div>
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('mrg_posts_square'); } else { margot_def_img(); } ?></a>
			</div>

			<?php endwhile; ?>

		</div>
    </div> <!-- ============================= /Featured Area Container -->

	<?php wp_reset_postdata(); else : ?>

<?php endif; ?>