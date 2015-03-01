<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<?php if ( false == get_post_meta($post->ID, 'margot_meta_posters') || !is_home() ) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="featured-thumb">
		<?php margot_data_over(true, true, true) ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'margot' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('mrg_posts_square'); ?></a>
	</div>
	<?php endif; ?>

	<div class="entry-content">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'margot' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta meta-buttons">
			<time class="meta-date icon-date " datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
			<?php margot_comments_nb('meta-com'); ?>
		</div>

		<p class="visible-lg"><?php wpe_excerpt('margot_extrdph', 'margot_extrmoredph'); ?></p>

	</div>

</article> 
<?php else : get_template_part( 'content-poster' ); endif; ?> 

<div class="unroll"><hr class="mrg-sep" /></div>