<?php

/**
 * @package margot
 * @since margot 1.0
 */
get_header();
?>

	<!-- ============================= Content Container -->
<div class="container container-image-content">
	<div id="mrg-wrap" class="omega">
		<div id="mrg-content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="image-content">

				<div class="media-meta">
				<?php
					$metadata = wp_get_attachment_metadata();
					printf(__('Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'margot'), esc_attr(get_the_date('c')), esc_html(get_the_date()), wp_get_attachment_url(), $metadata['width'], $metadata['height'], get_permalink($post->post_parent), get_the_title($post->post_parent));
				?>
				</div><!-- .entry-meta -->

				<nav id="image-navigation">
					<span class="previous-image"><?php previous_image_link(false, __('&larr; Previous', 'margot')); ?></span>
					<span class="next-image"><?php next_image_link(false, __('Next &rarr;', 'margot')); ?></span>
				</nav><!-- #image-navigation -->

				<div class="attachment">
					<?php
					$attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
					$next_attachment_url = wp_get_attachment_url(); ?>

					<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment"><?php $attachment_size = apply_filters('margot_attachment_size', array(1200, 1200)); echo wp_get_attachment_image($post->ID, $attachment_size); ?></a>
				</div><!-- .attachment -->

				<?php if (!empty($post->post_excerpt)): ?>
					<div class="entry-caption">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

			</div>

		<?php endwhile; endif; wp_reset_query(); ?>

	<!-- ============================= /Content Container -->

		</div> 
	</div>
</div>

<?php
get_footer();
?>