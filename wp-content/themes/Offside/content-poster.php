<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>
<div class="unroll-xs"><div id="mrg-poster-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<a href="<?php the_permalink(); ?>">
		<div class="mrg-chroma"></div>
		<?php the_post_thumbnail('mrg_featured_xl'); ?></a>

		<?php margot_data_over(false, true, true) ?>
		<div class="meta-info">
			<?php margot_category_style('single'); ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta meta-buttons meta-buttons-w">
				<time class="meta-date icon-date " datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
				<?php margot_comments_nb('meta-com'); ?>
			</div>
		</div>

	</article>
</div></div>