<?php
/**
 * @package margot
 * @since margot 1.0
 */


add_action('add_meta_boxes', 'margot_meta_box_add');
add_action('admin_enqueue_scripts', 'admin_enqueue_scripts');

function margot_meta_box_add() {
	add_meta_box('metabx-dph', __('Post Options - Margot Theme', 'margot'), 'margot_meta_box_cb', 'post', 'normal', 'high');
}

function admin_enqueue_scripts() {
	wp_enqueue_script('meta_box', get_template_directory_uri() . '/js/metabox.js', array('jquery'));
	wp_enqueue_style('metabox', get_template_directory_uri() . '/css/metabox.css', array(), '1.1', 'all');
}

function margot_meta_box_cb() {
	
	global $post;
	$values = get_post_custom($post->ID);
	
	$check_featured_post = isset($values['margot_meta_featured_post']) ? esc_attr($values['margot_meta_featured_post'][0]) : '';
	$check_poster_post = isset($values['margot_meta_posters']) ? esc_attr($values['margot_meta_posters'][0]) : '';
	$check_disable_sidebar = isset($values['margot_meta_sidebar']) ? esc_attr($values['margot_meta_sidebar'][0]) : '';
	$check_fb_comments = isset($values['margot_meta_fbcomms']) ? esc_attr($values['margot_meta_fbcomms'][0]) : '';
	$check_review_post = isset($values['margot_meta_reviewon']) ? esc_attr($values['margot_meta_reviewon'][0]) : '';
	
	wp_nonce_field('margot_meta_box_nonce', 'meta_box_nonce');
?> 

<p><input type="checkbox" id="margot_meta_featured_post" name="margot_meta_featured_post" <?php checked($check_featured_post, true); ?> />
<label for="margot_meta_featured_post"><?php _e('Featured Post', 'margot') ?></label></p>

<p><input type="checkbox" id="margot_meta_posters" name="margot_meta_posters" <?php checked($check_poster_post, true); ?> />
<label for="margot_meta_posters"><?php _e('Big Image (Latest News)', 'margot') ?></label></p>

<p><input type="checkbox" id="margot_meta_sidebar" name="margot_meta_sidebar" <?php checked($check_disable_sidebar, true); ?> />
<label for="margot_meta_sidebar"><?php _e('Disable Sidebar', 'margot') ?></label></p>

<p><input type="checkbox" id="margot_meta_fbcomms" name="margot_meta_fbcomms" <?php checked($check_fb_comments, true); ?> />
<label for="margot_meta_fbcomms"><?php _e('Facebook Comments', 'margot') ?></label></p>

<p><input type="checkbox" id="margot_meta_reviewon" name="margot_meta_reviewon" <?php checked($check_review_post, true); ?> />
<label for="margot_meta_reviewon"><?php _e('Review Post', 'margot') ?></label></p>

<div id="hidereview" style="display:none;">

	<h3 class='hndle review-title'><span><?php _e('Review', 'margot') ?></span></h3>

	<p class="sec-rev"><label class="label-score" for="margot_meta_review_score"><?php _e('Overall Score', 'margot') ?></label>
	<input type="number" name="margot_meta_review_score" id="margot_meta_review_score" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_score', true) ?>" /></p>

	<p class="sec-rev"><label class="label-tag" for="margot_meta_review_title"><?php _e('Header Title', 'margot') ?></label>
	<input type="text" class="input-title" name="margot_meta_review_title" id="margot_meta_review_title" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_title', true) ?>" /></p>


	<div class="clearfix"></div>


	<p class="inside"><label class="label-summ" for="margot_meta_review_summ"><?php _e('Review Summary', 'margot') ?></label>
	<textarea name="margot_meta_review_summ" id="margot_meta_review_summ" rows="10" cols="40"><?php echo get_post_meta($post->ID, 'margot_meta_review_summ', true) ?></textarea></p>

	<h3 class='hndle review-title'><span><?php _e('Criteria', 'margot') ?></span></h3>

	<p class="criter"><label class="screen-reader-texft" for="margot_meta_review_criterion_1"><?php _e('Criterion 1', 'margot') ?></label>
	<input type="text" name="margot_meta_review_criterion_1" id="margot_meta_review_criterion_1" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_1', true) ?>" />

	<label class="screen-reader-text" for="margot_meta_review_criterion_score_1"><?php _e('Criterion Score 1', 'margot') ?></label>
	<input class="input-sc" type="number" name="margot_meta_review_criterion_score_1" id="margot_meta_review_criterion_score_1" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_score_1', true) ?>" /></p>

	<p class="criter"><label class="screen-reader-texft" for="margot_meta_review_criterion_2"><?php _e('Criterion 2', 'margot') ?></label>
	<input type="text" name="margot_meta_review_criterion_2" id="margot_meta_review_criterion_2" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_2', true) ?>" />

	<label class="screen-reader-text" for="margot_meta_review_criterion_score_1"><?php _e('Criterion Score 2', 'margot') ?></label>
	<input class="input-sc" type="number" name="margot_meta_review_criterion_score_2" id="margot_meta_review_criterion_score_2" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_score_2', true) ?>" /></p>

	<p class="criter"><label class="screen-reader-texft" for="margot_meta_review_criterion_3"><?php _e('Criterion 3', 'margot') ?></label>
	<input type="text" name="margot_meta_review_criterion_3" id="margot_meta_review_criterion_3" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_3', true) ?>" />

	<label class="screen-reader-text" for="margot_meta_review_criterion_score_1"><?php _e('Criterion Score 3', 'margot') ?></label>
	<input class="input-sc" type="number" name="margot_meta_review_criterion_score_3" id="margot_meta_review_criterion_score_3" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_score_3', true) ?>" /></p>

	<p class="criter"><label class="screen-reader-texft" for="margot_meta_review_criterion_4"><?php _e('Criterion 4', 'margot') ?></label>
	<input type="text" name="margot_meta_review_criterion_4" id="margot_meta_review_criterion_4" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_4', true) ?>" />

	<label class="screen-reader-text" for="margot_meta_review_criterion_score_4"><?php _e('Criterion Score 4', 'margot') ?></label>
	<input class="input-sc" type="number" name="margot_meta_review_criterion_score_4" id="margot_meta_review_criterion_score_4" min="0" max="100" value="<?php echo get_post_meta($post->ID, 'margot_meta_review_criterion_score_4', true) ?>" /></p>
	<div class="clearfix"></div>

</div>

	<?php
}

add_action('save_post', 'margot_meta_box_save');
function margot_meta_box_save($post_id) {
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'margot_meta_box_nonce')) return;
	if (!current_user_can('edit_post', $post_id)) return;
	$allowed = array('a' => array('href' => array()));
	
	$me_fields = array('margot_meta_review_score', 'margot_meta_review_title', 'margot_meta_review_summ', 'margot_meta_review_criterion_1', 'margot_meta_review_criterion_score_1', 'margot_meta_review_criterion_2', 'margot_meta_review_criterion_score_2', 'margot_meta_review_criterion_3', 'margot_meta_review_criterion_score_3', 'margot_meta_review_criterion_4', 'margot_meta_review_criterion_score_4');
	
	$me_checks = array('margot_meta_featured_post', 'margot_meta_posters', 'margot_meta_sidebar', 'margot_meta_fbcomms', 'margot_meta_reviewon',);
	
	foreach ($me_checks as $me_ck) {
		
		$me_meta = isset($_POST[$me_ck]) && !empty($_POST[$me_ck]) ? true : false;
		
		if (isset($_POST[$me_ck]) && !empty($_POST[$me_ck])) {
			update_post_meta($post_id, $me_ck, $me_meta);
		} else {
			delete_post_meta($post_id, $me_ck);
		}

	}
	
	foreach ($me_fields as $me_fd) {
		$me_review = get_post_meta($post->ID, 'margot_meta_reviewon', true);
		if (isset($_POST[$me_fd]) && !empty($_POST[$me_fd])) {
			update_post_meta($post_id, $me_fd, wp_kses($_POST[$me_fd], $allowed));
		} else {
			delete_post_meta($post_id, $me_fd);
		}
	}
}

?>