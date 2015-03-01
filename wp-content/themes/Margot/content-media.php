<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>


<div class="container container-carousel hidden-xs">
	<div id="mrg-media-box" class="omega media-panel">

		<div class="unroll"><h3 class="pretitle center-title"><span><?php echo of_get_option( 'carousel_title', '' ); ?></span></h3></div>

		<div class="owl-carousel owl-theme">
				<?php

				$filter_cat = of_get_option( 'filter_carousel_cats', '0' );
				$post_format = of_get_option( 'filter_carousel_format', 'standard' );

				if('reviews' == of_get_option( 'filter_carousel_format', 'standard' )){
					$posts_key = 'margot_meta_reviewon';
				}
				elseif('featured' == of_get_option( 'filter_carousel_format', 'standard' )){
					$posts_key = 'margot_meta_featured_post';
				}
				else{
					$posts_key = false;
				}

				$args = array(
					'cat' => $filter_cat,
					'posts_per_page' => 6,
					'ignore_sticky_posts' => 1,
					'meta_key' => $posts_key,
					);

				if (in_array($post_format, array('video', 'audio', 'gallery'))) {
					$tax_format = array(
						'tax_query' => array(
							array(
								'taxonomy' => 'post_format',
								'terms' => array("post-format-$post_format") ,
								'field' => 'slug',
								'operator' => 'IN',
								),
							)
						);
					$args = array_merge($args, $tax_format);
				}

				$wp_posts = new WP_Query( $args );
				if ( $wp_posts->have_posts() ) :
					while ( $wp_posts->have_posts() ) : $wp_posts->the_post();
				?>

 				<div class="item">
 					<?php margot_data_over(false, true, true, "80") ?>
					<a href="<?php the_permalink(); ?>"><div class="mrg-chroma"></div> <?php if ( has_post_thumbnail() ) { the_post_thumbnail('mrg_carousel'); } else { margot_def_img(); } ?></a>

					<div class="post-inner">
						
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'margot' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="entry-meta meta-buttons meta-buttons-w">
							<time class="meta-date icon-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
							<?php margot_comments_nb('meta-com'); ?>
						</div>
					</div>
				</div>

				<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>
	</div>
</div>