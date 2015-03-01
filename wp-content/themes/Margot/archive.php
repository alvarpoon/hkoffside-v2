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
				<div class="unroll"><h3 class="pretitle"><span><?php
				if (is_category()) {
					printf(__('Category Archives: %s', 'margot'), single_cat_title('', false));
				} elseif (is_tag()) {
					printf(__('Tag Archives: %s', 'margot'), single_tag_title('', false));
				} elseif (is_author()) {
					the_post();
					printf(__('Author Archives: %s', 'margot'), '<a class="vcard url fn n" href="' . get_author_posts_url(get_the_author_meta("ID")) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a>');
					rewind_posts();
				} elseif (is_day()) {
					printf(__('Daily Archives: %s', 'margot'), get_the_date());
				} elseif (is_month()) {
					printf(__('Monthly Archives: %s', 'margot'), get_the_date('F Y'));
				} elseif (is_year()) {
					printf(__('Yearly Archives: %s', 'margot'), get_the_date('Y'));
				} else {
					_e('Archives', 'margot');
					}?></span></h3></div>

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