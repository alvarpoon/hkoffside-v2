<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="mrg-post-header">
		<div class="untop">
			<div id="mrg-featured-media">
			<?php margot_post_head(); ?>
			</div>
		</div>

		<div class="mrg-head-title">
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php single_post_title(); ?> </a></h2>

			<div class="entry-meta meta-buttons meta-buttons">
				<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" class="meta-author icon-author"><?php the_author(); ?></a>
				<time class="meta-date icon-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
				<?php margot_comments_nb('meta-com'); ?>
			</div>
		</div>
	</header>

	<div id="mrg-content" class="mrg-post-inner <?php echo margot_custom_class(); ?>">

		<div class="entry-content">
			<?php the_content(); ?>
			<?php $args = array('before'=> '<p class="dphpost-pages"><span class="pgopen">' . __('Pages:', 'margot') .'','after'=> '</p>','link_before'=> '','link_after'=> '','next_or_number'=> 'number','pagelink'=> '<span>%</span>','echo'=> 1); wp_link_pages( $args ); ?>
		</div>

		<?php if(get_post_meta($post->ID, 'margot_meta_reviewon', true)) margot_scored_panel(); ?>

		<?php if ( get_the_tags() ) { the_tags('<ul class="entry-tags icon-tag hidden-xs"><li>','</li><li>','</li></ul>'); } ?>

		<div class="info-share"><?php margot_sharebt(); ?></div>

		<?php if (of_get_option('author_box', true)) : ?>
		<div class="unroll"><footer class="footer-meta author-cc">
			<?php echo get_avatar( get_the_author_meta('ID'), 140 ); ?>
			<h4><?php _e('About','margot') ?> <?php the_author(); ?></h4>
			<a class="mini-author" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('view all posts', 'margot'); ?></a>
			<span class="mini-icons hidden-xs"><?php margot_author_icons(); ?></span>
			<p class="author-bio"><?php the_author_meta('description'); ?></p>
		</footer></div>
		<?php endif; ?>

		<?php if (of_get_option('related_posts', true)) { get_template_part( 'inc/related-posts' ); } ?>

		<div class="load-comments">
			<div class="pretag"><?php margot_comments_nb('meta-com'); ?> <?php _e('Comments', 'margot'); ?></div>
			<h3 class="presub"><a href="#respond"><?php _e('Join the Conversation', 'margot'); ?> &rarr;</a></h3>
		</div>

		<div class="up-comments <?php if (of_get_option('hide_comments', true)) { echo 'hidden-comments'; } ?>">
			<?php if (get_post_meta($post->ID, 'margot_meta_fbcomms', true)) {
				echo '<div id="fb-comments" class="fb-comments" data-width="100%" data-href="'. get_permalink() .'" data-num-posts="'.of_get_option('fb_comments_limit', '10').'"></div>'; }
				elseif ( comments_open() || '0' != get_comments_number() ) {
							comments_template( '', true );
			} ?>
		</div>

		<div class="wave"></div> <div class="unroll"><hr class="mrg-sep" /></div>

	</div>

</article>