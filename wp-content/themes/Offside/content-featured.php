<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<div class="container container-featured-posts <?php if (!of_get_option('mrg_color_overlay', false)) {echo 'active-ov';} ?>">
	<div id="mrg-featured-area">

				<?php $i=0;
				$filter_cat = of_get_option( 'filter_featured_cats', '0' );
				$post_format = of_get_option( 'filter_featured_format', 'standard' );
				$num_posts = of_get_option( 'featured_posts_number', '5' );

				$posts_key = false;
				if('reviews' == of_get_option( 'filter_featured_format', 'standard' )){
					$posts_key = 'margot_meta_reviewon';
				}
				elseif('featured' == of_get_option( 'filter_featured_format', 'standard' )){
					$posts_key = 'margot_meta_featured_post';
				}

				$args = array(
					'cat' => $filter_cat,
					'posts_per_page' => $num_posts,
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
					while ( $wp_posts->have_posts() ) : $wp_posts->the_post(); $i++;

				$top_item = "1" == $i ? true : false;
				$top_label = of_get_option('featured_title', 'Featured Now');
				$item_class = $top_item ? 'mrb-box-top col-sm-12' : 'col-xs-6 col-sm-6';
				$src_xl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mrg_featured_xl');
				$src_l = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mrg_featured_l');
				$src_m = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mrg_featured_m');
				?>

					<div class="<?php echo $item_class; ?> mrg-featured-grid col-md-4 nopadding">

						<div class="mrg-box mrg-item mrg-item-<?php echo $i; ?>">

							<?php if($top_item && $top_label) {echo '<span class="top-ticket icon-ticket">'.$top_label.'</span>';} ?>

							<?php margot_data_over(false, true, true) ?>

							<div class="meta-info">
								<?php margot_category_style('single'); ?>
								<h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>

							<a href="<?php the_permalink(); ?>" class="link-border">
							<?php if($top_item && has_post_thumbnail() ) { ?>
									<img width="380" height="520" class="hidden-xs hidden-sm" src="<?php echo esc_attr( $src_l[0] ); ?>" alt="<?php the_title(); ?>" />
									<img width="750" height="550" class="hidden-md hidden-lg" src="<?php echo esc_attr( $src_xl[0] ); ?>" alt="<?php the_title(); ?>" />
							<?php } elseif (has_post_thumbnail()) { ?>
									<img width="380" height="260" src="<?php echo esc_attr( $src_m[0] ); ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
							<div class="mrg-chroma"></div>
							</a>

						</div> <!-- /mrg-box -->
						
					</div>

				<?php endwhile; endif; wp_reset_postdata(); ?>


	</div>
</div> <!-- /mrg-featured-area -->