<?php
/**
 * margot widgets
 *
 * @package margot
 * @since margot 1.0
 */
/* Custom Tags Widget
 =================================================================================================== */
class margot_tags_widget extends WP_Widget {
	function margot_tags_widget() {
		$widget_ops = array(
			'classname' => 'widget_tags_margot',
			'description' => __("Display a cloud list of tags. Exclude and Include options.", 'margot')
		);
		$this->WP_Widget('margot_tags_widget', __('/Margot: Tag Cloud', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$tags_include = apply_filters('tags_include', $instance['tags_include']);
		$tags_exclude = apply_filters('tags_exclude', $instance['tags_exclude']);
		$tags_number = apply_filters('tags_number', $instance['tags_number']);
?>

  <?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

<?php $args = array(
			'smallest' => 8,
			'largest' => 12,
			'unit' => 'pt',
			'number' => '' . $tags_number . '',
			'format' => 'list',
			'orderby' => 'name',
			'order' => 'ASC',
			'exclude' => '' . $tags_exclude . '',
			'include' => '' . $tags_include . '',
			'link' => 'view',
			'taxonomy' => 'post_tag',
			'echo' => true
		);
		wp_tag_cloud($args); ?>

	<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['tags_include'] = strip_tags($new_instance['tags_include']);
		$instance['tags_exclude'] = strip_tags($new_instance['tags_exclude']);
		$instance['tags_number'] = strip_tags($new_instance['tags_number']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$tags_include = isset($instance['tags_include']) ? $instance['tags_include'] : '';
		$tags_exclude = isset($instance['tags_exclude']) ? $instance['tags_exclude'] : '';
		$tags_number = isset($instance['tags_number']) ? absint($instance['tags_number']) : '18';
?>

<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<p><label style="display:block;" for="<?php echo $this->get_field_id('tags_include'); ?>"><strong>Include (Optional)</strong></label>
  <small>Comma separated list of tags IDs to only show those (Eg: 8,16,21).</small>
  <input class="widefat" id="<?php echo $this->get_field_id('tags_include', 'margot'); ?>" name="<?php echo $this->get_field_name('tags_include', 'margot'); ?>" type="text" value="<?php echo esc_attr($tags_include); ?>" /></p>

<p><label style="display:block;" for="<?php echo $this->get_field_id('tags_exclude'); ?>"><strong>Exclude (Optional)</strong></label>  <small>Comma separated list of tags IDs to exclude. (Eg: 12,33). (Include must be empty).</small>
  <input class="widefat" id="<?php echo $this->get_field_id('tags_exclude', 'margot'); ?>" name="<?php echo $this->get_field_name('tags_exclude', 'margot'); ?>" type="text" value="<?php echo esc_attr($tags_exclude); ?>" /></p>

<p><label for="<?php echo $this->get_field_id('tags_number'); ?>">How many tags to show (0 = Display all tags)</label> 
  <input id="<?php echo $this->get_field_id('tags_number', 'margot'); ?>" name="<?php echo $this->get_field_name('tags_number', 'margot'); ?>" type="number" min="0" max="50" value="<?php echo esc_attr($tags_number); ?>" /></p>

<?php
	}
}

function margot_tags_widgetInit() {
	register_widget('margot_tags_widget');
}
add_action('widgets_init', 'margot_tags_widgetInit');

/* Custom Categories Widget
 =================================================================================================== */
class margot_cats_widget extends WP_Widget {
	function margot_cats_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_cats_margot',
			'description' => __("Display a list of categories. Exclude and Include options.", 'margot')
		);
		$this->WP_Widget('margot_cats_widget', __('/Margot: List Categories', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$cats_include = apply_filters('cats_include', $instance['cats_include']);
		$cats_exclude = apply_filters('cats_exclude', $instance['cats_exclude']);
		$cats_number = apply_filters('cats_number', $instance['cats_number']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

  <ul><?php $args = array(
			'exclude' => '' . $cats_exclude . '',
			'include' => '' . $cats_include . '',
			'hierarchical' => 1,
			'title_li' => '',
			'show_option_none' => 'Null',
			'number' => '' . $cats_number . '',
			'echo' => 1,
			'depth' => 0,
			'current_category' => 0,
			'pad_counts' => 0,
			'taxonomy' => 'category',
			'walker' => null
		);
		
		wp_list_categories($args); ?></ul> 

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['cats_include'] = strip_tags($new_instance['cats_include']);
		$instance['cats_exclude'] = strip_tags($new_instance['cats_exclude']);
		$instance['cats_number'] = strip_tags($new_instance['cats_number']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$cats_include = isset($instance['cats_include']) ? $instance['cats_include'] : '';
		$cats_exclude = isset($instance['cats_exclude']) ? $instance['cats_exclude'] : '';
		$cats_number = isset($instance['cats_number']) ? absint($instance['cats_number']) : '0';
?>

<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<p><label style="display:block;" for="<?php echo $this->get_field_id('cats_include'); ?>"><strong>Include (Optional)</strong></label>
  <small>Comma separated list of category IDs to only show those (Eg: 8,16,21).</small>
  <input class="widefat" id="<?php echo $this->get_field_id('cats_include', 'margot'); ?>" name="<?php echo $this->get_field_name('cats_include', 'margot'); ?>" type="text" value="<?php echo esc_attr($cats_include); ?>" /></p>

<p><label style="display:block;" for="<?php echo $this->get_field_id('cats_exclude'); ?>"><strong>Exclude (Optional)</strong></label>  <small>Comma separated list of category IDs to exclude. (Eg: 12,33). (Include must be empty).</small>
  <input class="widefat" id="<?php echo $this->get_field_id('cats_exclude', 'margot'); ?>" name="<?php echo $this->get_field_name('cats_exclude', 'margot'); ?>" type="text" value="<?php echo esc_attr($cats_exclude); ?>" /></p>

<p><label for="<?php echo $this->get_field_id('cats_number'); ?>">How many categories to show (0 = Display all categories)</label> 
  <input id="<?php echo $this->get_field_id('cats_number', 'margot'); ?>" name="<?php echo $this->get_field_name('cats_number', 'margot'); ?>" type="number" min="0" max="50" value="<?php echo esc_attr($cats_number); ?>" /></p>

<?php
	}
}

function margot_cats_widgetInit() {
	register_widget('margot_cats_widget');
}
add_action('widgets_init', 'margot_cats_widgetInit');

/* Custom Tag Cloud Widget
 =================================================================================================== */

add_filter('widget_tag_cloud_args', 'margot_wp_tag_cloud');
function margot_wp_tag_cloud($args) {
	$args = array(
		'smallest' => 8,
		'largest' => 12,
		'format' => 'list'
	);
	return $args;
}

/* Social Icons Widget
 =================================================================================================== */
class margot_icons_widget extends WP_Widget {
	function margot_icons_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_icons',
			'description' => __("Display Social Icons", 'margot')
		);
		$this->WP_Widget('margot_icons_widget', __('/Margot: Social Icons', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>


  <div class="mini-icons"><?php margot_icons(); ?></div><div class="clearfix"></div>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
?>

<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

<?php
	}
}

function margot_icons_widgetInit() {
	register_widget('margot_icons_widget');
}
add_action('widgets_init', 'margot_icons_widgetInit');

/* List Authors Widgets
 =================================================================================================== */
class margot_authors_widget extends WP_Widget {
	function margot_authors_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_authors',
			'description' => __("List Blog Editors with Avatar", 'margot')
		);
		$this->WP_Widget('margot_authors_widget', __('/Margot: List Authors', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

<?php function contributors() {
			global $wpdb;
			$authors = array();
			$levels = array(
				'administrator',
				'editor',
				'author'
			);
			foreach ($levels as $level):
				$users_query = new WP_User_Query(array(
					'fields' => 'all_with_meta',
					'role' => $level,
					'orderby' => 'display_name'
				));
				$list = $users_query->get_results();
				if ($list) $authors = array_merge($authors, $list);
			endforeach;
			foreach ($authors as $author) {
				echo "<li class=\"tooltip_init\"><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"" . get_the_author_meta('display_name', $author->ID) . "\" href=\"" . home_url() . "/?author=" . $author->ID . "\">" . get_the_author_meta('display_name', $author->ID) . "</a></li>";
			}
		}; ?>

	<ul class="list-editors"><?php contributors(); ?></ul>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>

<?php
	}
}

function margot_authors_widgetInit() {
	register_widget('margot_authors_widget');
}
add_action('widgets_init', 'margot_authors_widgetInit');

/* Post from Category
 =================================================================================================== */
class margot_catposts_widget extends WP_Widget {
	function margot_catposts_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_catposts',
			'description' => __("Display recent posts from category", 'margot')
		);
		$this->WP_Widget('margot_catposts_widget', __('/Margot: Category Posts', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$postnumb = apply_filters('widget_postnumb', $instance['postnumb']);
		$nn_cat = apply_filters('widget_nn_cat', $instance['nn_cat']);
		
		$args = array(
			'cat' => $nn_cat,
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $postnumb,
		);
		
		$wp_posts = new WP_Query($args);
		if ($wp_posts->have_posts()):
?>
		
<?php echo $before_widget; ?><?php if ($title) {
				echo $before_title . $title . $after_title;
			} ?>
<div class="owl-carousel yk-slider owl-theme">


 <?php while ($wp_posts->have_posts()):
				$wp_posts->the_post(); ?>

	<div class="item">
		<?php margot_data_over(false, true, true) ?>
	  <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark">
	  <?php if (has_post_thumbnail()) {
					the_post_thumbnail('mrg_posts_square');
				} else {
					margot_def_img();
				} ?>
		<h2><?php the_title(); ?></h2></a>

	</div>

  <?php
			endwhile;
		endif;
		wp_reset_postdata(); ?>
 
</div>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['postnumb'] = strip_tags($new_instance['postnumb']);
		$instance['nn_cat'] = strip_tags($new_instance['nn_cat']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$postnumb = isset($instance['postnumb']) ? $instance['postnumb'] : '3';
		$nn_cat = isset($instance['nn_cat']) ? $instance['nn_cat'] : false;
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e("Category:", 'margot'); ?></label> 
<br />
	  <?php
		$category_args = array(
			'show_count' => 1,
			'hide_empty' => 0,
			'id' => $this->get_field_id('nn_cat') ,
			'class' => 'widefat',
			'name' => $this->get_field_name('nn_cat') ,
			'selected' => $nn_cat ? $nn_cat : false,
		);
		wp_dropdown_categories($category_args);
?>
</p>
<p>
<label for="<?php echo $this->get_field_id('postnumb'); ?>"><?php _e("Number of posts:", 'margot'); ?></label> 
<input width="20" style="width:20%;" id="<?php echo $this->get_field_id('postnumb'); ?>" name="<?php echo $this->get_field_name('postnumb'); ?>" type="number" min="0" max="10" value="<?php echo esc_attr($postnumb); ?>" />
</p>
<p>

<input type="hidden" id="sideFeature-Submit" name="sideFeature-Submit" value="1" />

</p>

<?php
	}
}

function margot_catposts_widgetInit() {
	register_widget('margot_catposts_widget');
}
add_action('widgets_init', 'margot_catposts_widgetInit');

/* Single Widget Ad (300x300)
 =================================================================================================== */

class margot_admed_widget extends WP_Widget {
	function margot_admed_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_admed',
			'description' => __("Display your Ads.", 'margot')
		);
		$this->WP_Widget('margot_admed_widget', __('/Margot: Single Ad Banner', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

		<?php if(of_get_option('ad_medium_uploader', 'no entry')) : ?>
		<div class="single-bb"><a href="<?php echo esc_url(of_get_option('ad_medium_link', 'no entry')); ?>"><img src="<?php echo of_get_option('ad_medium_uploader', 'no entry'); ?>" class="img-responsive" alt="Header Banner" /></a></div>
		<?php endif; ?>

		<div class="bnr-section">
			<?php echo of_get_option('adsense_widget', false) ?>
		</div>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>

<?php
	}
}

function margot_admed_widgetInit() {
	register_widget('margot_admed_widget');
}
add_action('widgets_init', 'margot_admed_widgetInit');

/* Widget Ads (150x150)
 =================================================================================================== */

class margot_adsqu_widget extends WP_Widget {
	function margot_adsqu_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_adsqu',
			'description' => __("Display your Ads.", 'margot')
		);
		$this->WP_Widget('margot_adsqu_widget', __('/Margot: Ads (125x125)', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

<ul class="ad_square">

	<li><a href="<?php echo esc_url(of_get_option('ad_square_link_1', 'no entry')); ?>"><img src="<?php echo of_get_option('ad_square_uploader_1', 'no entry'); ?>" alt="Square Ad" /></a>
	</li>

	<li><a href="<?php echo esc_url(of_get_option('ad_square_link_2', 'no entry')); ?>"><img src="<?php echo of_get_option('ad_square_uploader_2', 'no entry'); ?>" alt="Square Ad" /></a>
  </li>

	<li><a href="<?php echo esc_url(of_get_option('ad_square_link_3', 'no entry')); ?>"><img src="<?php echo of_get_option('ad_square_uploader_3', 'no entry'); ?>" alt="Square Ad" /></a>
	</li>

	<li><a href="<?php echo esc_url(of_get_option('ad_square_link_4', 'no entry')); ?>"><img src="<?php echo of_get_option('ad_square_uploader_4', 'no entry'); ?>" alt="Square Ad" /></a>
	</li>

</ul>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>

<?php
	}
}

function margot_adsqu_widgetInit() {
	register_widget('margot_adsqu_widget');
}
add_action('widgets_init', 'margot_adsqu_widgetInit');

/* Facebook Like Box widget
 =================================================================================================== */

class margot_fblike_widget extends WP_Widget {
	function margot_fblike_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_fblike',
			'description' => __("Add a Facebook Like Box", 'margot')
		);
		$this->WP_Widget('margot_fblike_widget', __('/Margot: Facebook Like Box', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$fburl = apply_filters('fburl', $instance['fburl']);
		$fbstream = isset($instance['fbstream']) ? apply_filters('fbstream', $instance['fbstream']) : 0;
?>

<?php echo $before_widget; ?><?php if ($title) {
	echo $before_title . $title . $after_title;
} ?>


<div id="fb-root"></div>
<div class="fb-like-box" data-href="<?php echo esc_url($fburl); ?>" data-width="100%" data-height="320" data-show-faces="true" data-stream="<?php if ($fbstream) echo "true"; ?>" data-colorscheme="light" data-show-border="true" data-header="false"></div>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fburl'] = strip_tags($new_instance['fburl']);
		$instance['fbstream'] = strip_tags($new_instance['fbstream']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$fburl = isset($instance['fburl']) ? $instance['fburl'] : '';
		$fbstream = isset($instance['fbstream']) ? $instance['fbstream'] : 0;
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('fburl'); ?>">Facebook Page URL</label> 
  <input class="widefat" id="<?php echo $this->get_field_id('fburl', 'margot'); ?>" name="<?php echo $this->get_field_name('fburl', 'margot'); ?>" type="text" value="<?php echo esc_attr($fburl); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('fbstream'); ?>"><?php _e('Show posts', 'margot') ?></label>
<input type="checkbox" id="<?php echo $this->get_field_id('fbstream', 'margot'); ?>" name="<?php echo $this->get_field_name('fbstream', 'margot'); ?>" value="1" <?php checked(esc_attr($fbstream), true); ?> />
</p>

<?php
	}
}

function margot_fblike_widgetInit() {
	register_widget('margot_fblike_widget');
}
add_action('widgets_init', 'margot_fblike_widgetInit');

/* Recent Comments Widget
 =================================================================================================== */

class margot_recentcomms_widget extends WP_Widget {
	function margot_recentcomms_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_recentcomms',
			'description' => __("Display recent comments with author gravatar", 'margot')
		);
		$this->WP_Widget('margot_recentcomms_widget', __('/Margot: Recent Comments w/Avatar', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$commnumb = apply_filters('widget_commnumb', $instance['commnumb']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

			  <ul>
<?php $comments = get_comments('status=approve&number=' . $commnumb . ''); ?>
<?php foreach ($comments as $comment) { ?>
				<li><a class="author-av" href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID ?>"><?php echo get_avatar($comment, '100'); ?></a>

				  <p class="comment-text"><strong><?php echo strip_tags($comment->comment_author); ?>:</strong> <a href="<?php echo get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID ?>"><?php echo wp_html_excerpt($comment->comment_content, 60); ?>...</a></p>
				</li> 
<?php
		} ?>
			  </ul>
<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['commnumb'] = strip_tags($new_instance['commnumb']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$commnumb = isset($instance['commnumb']) ? $instance['commnumb'] : '5';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('commnumb'); ?>"><?php _e("Number of comments:", 'margot'); ?></label> 
<input width="20" style="width:20%;" id="<?php echo $this->get_field_id('commnumb'); ?>" name="<?php echo $this->get_field_name('commnumb'); ?>" type="text" value="<?php echo esc_attr($commnumb); ?>" />
</p>
<?php
	}
}

function margot_recentcomms_widgetInit() {
	register_widget('margot_recentcomms_widget');
}
add_action('widgets_init', 'margot_recentcomms_widgetInit');

/* Most Popular Widget
 =================================================================================================== */
class margot_mostpop_widget extends WP_Widget {
	function margot_mostpop_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_mostpop',
			'description' => __("Display most popular posts based on comments or views", 'margot')
		);
		$this->WP_Widget('margot_mostpop_widget', __('/Margot: Popular Posts', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$postbase = apply_filters('widget_postbase', $instance['postbase']);
		$postperiod = apply_filters('widget_postperiod', $instance['postperiod']);
		$postnumb = apply_filters('widget_postnumb', $instance['postnumb']);
		
		$args = array(
			'ignore_sticky_posts' => 1,
			'year' => ('Current Month' == $postperiod || 'Current Week' == $postperiod) ? date('Y') : false,
			'monthnum' => ('Current Month' == $postperiod) ? date('m') : false,
			'w' => ('Last Week' == $postperiod) ? date('W')-1 : false,
			'posts_per_page' => $postnumb,
			'meta_key' => ('Post Views' == $postbase) ? 'post_views_count' : false,
			'orderby' => ('Post Views' == $postbase) ? 'meta_value_num' : 'comment_count',
		);
?>
		
<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

   <?php $count = 0;
		$wp_posts = new WP_Query($args);
		if ($wp_posts->have_posts()):
			while ($wp_posts->have_posts()):
				$wp_posts->the_post();
				$count++
?>

	<?php if (1 == $count): ?>
	<div class="header-wg hidden-sm hidden-xs top-post">
	  <?php margot_data_over(true, true, true) ?>
	  <?php if (has_post_thumbnail()) {
						the_post_thumbnail('mrg_posts_square');
					} else {
						margot_def_img();
					} ?>
	</div>
	<?php endif; ?>

	<div class="pie-wg">
	  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	  <div class="entry-meta">
		<time class="meta-date icon-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time>
		
		<?php if ($postbase == "Post Comments") {
					margot_comments_nb('meta-com');
				} else {
					echo '<a title="'.__('Total Views', 'margot').'" class="meta-views icon-views" href=" ' . get_permalink() . '  "> ' . margot_getPostViews(get_the_ID()) . '</a>';
				} ?>
		  
	  </div>
	</div>


  <?php
			endwhile;
		endif;
		wp_reset_postdata(); ?>



<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['postbase'] = strip_tags($new_instance['postbase']);
		$instance['postperiod'] = strip_tags($new_instance['postperiod']);
		$instance['postnumb'] = strip_tags($new_instance['postnumb']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$postbase = isset($instance['postbase']) ? $instance['postbase'] : '';
		$postperiod = isset($instance['postperiod']) ? $instance['postperiod'] : '';
		$postnumb = isset($instance['postnumb']) ? $instance['postnumb'] : '3';
?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('postnumb'); ?>"><?php _e("Number of posts:", 'margot'); ?></label> 
<input width="20" style="width:20%;" id="<?php echo $this->get_field_id('postnumb'); ?>" name="<?php echo $this->get_field_name('postnumb'); ?>" type="number" min="0" max="10" value="<?php echo esc_attr($postnumb); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('postbase'); ?>"><?php _e("Filter by:", 'margot'); ?></label> 
<select name="<?php echo $this->get_field_name('postbase'); ?>" id="<?php echo $this->get_field_id('postbase'); ?>" class="widefat">
<?php
		$options = array(
			__('Post Comments', 'margot') ,
			__('Post Views', 'margot')
		);
		foreach ($options as $option) {
			echo '<option value="' . $option . '" id="postbase"', $postbase == $option ? ' selected="selected"' : '', '>', $option, '</option>';
		}
?>

</select>
</p>

<p>
<label for="<?php echo $this->get_field_id('postperiod'); ?>"><?php _e("Published:", 'margot'); ?></label> 
<select name="<?php echo $this->get_field_name('postperiod'); ?>" id="<?php echo $this->get_field_id('postperiod'); ?>" class="widefat">
<?php
		$options = array(
			__('All Time', 'margot') ,
			__('Current Month', 'margot'),
			__('Last Week', 'margot')
		);
		foreach ($options as $option) {
			echo '<option value="' . $option . '" id="postperiod"', $postperiod == $option ? ' selected="selected"' : '', '>', $option, '</option>';
		}
?>

</select>
</p>

<?php
	}
}

function margot_mostpop_widgetInit() {
	register_widget('margot_mostpop_widget');
}
add_action('widgets_init', 'margot_mostpop_widgetInit');

/* Latest Posts Widget
 =================================================================================================== */

class margot_latest_widget extends WP_Widget {
	function margot_latest_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_latestposts',
			'description' => __("Display recent posts with thumbnail", 'margot')
		);
		$this->WP_Widget('margot_latest_widget', __('/Margot: Latest Posts', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$postnumb = apply_filters('widget_postnumb', $instance['postnumb']);
		
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $postnumb
		);
		
		$wp_posts = new WP_Query($args);
		if ($wp_posts->have_posts()):
?>

<?php echo $before_widget; ?><?php if ($title) {
				echo $before_title . $title . $after_title;
			} ?>

  <ul>
  <?php while ($wp_posts->have_posts()):
				$wp_posts->the_post(); ?>
  <li>
	<?php if (has_post_thumbnail()) {
					the_post_thumbnail('thumbnail');
				} else {
					margot_def_img();
				} ?> 

	<div class="li-content cell"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a> 
	  <div class="meta-wg"><time class="meta-date icon-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('F j, Y'); ?></time> <?php margot_comments_nb('comments-meta'); ?></div>
	</div></li> 
  <?php
			endwhile;
		endif;
		wp_reset_postdata(); ?>
</ul>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['postnumb'] = strip_tags($new_instance['postnumb']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$postnumb = isset($instance['postnumb']) ? $instance['postnumb'] : '3';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('postnumb'); ?>"><?php _e("Number of posts:", 'margot'); ?></label> 
<input width="20" style="width:20%;" id="<?php echo $this->get_field_id('postnumb'); ?>" name="<?php echo $this->get_field_name('postnumb'); ?>" type="text" value="<?php echo esc_attr($postnumb); ?>" />
</p>
<?php
	}
}

function margot_latest_widgetInit() {
	register_widget('margot_latest_widget');
}
add_action('widgets_init', 'margot_latest_widgetInit');

/* Video Posts Widget
 =================================================================================================== */
 
class margot_video_widget extends WP_Widget {
	function margot_video_widget() {
		
		$widget_ops = array(
			'classname' => 'widget_margot_video',
			'description' => __("Add a video widget", 'margot')
		);
		$this->WP_Widget('widget_margot_video', __('/Margot: Video', 'margot') , $widget_ops);
	}
	/** Widget Content */
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$embed = apply_filters('embed', $instance['embed']);
?>

<?php echo $before_widget; ?><?php if ($title) {
			echo $before_title . $title . $after_title;
		} ?>

  <div class="video-in embed-responsive embed-responsive-16by9"><?php echo $embed; ?></div>

<?php echo $after_widget; ?> <?php
	}
	/** WP_Widget Update */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['embed'] = preg_replace("#<(?!/?iframe[ >])#i", "&lt;", $new_instance['embed']);
		return $new_instance;
	}
	
	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$embed = isset($instance['embed']) ? $instance['embed'] : '';
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'margot'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('embed'); ?>">Video Embed Code</label> 
  <input class="widefat" id="<?php echo $this->get_field_id('embed', 'margot'); ?>" name="<?php echo $this->get_field_name('embed', 'margot'); ?>" type="text" value="<?php echo esc_attr($embed); ?>" />
</p>

<?php
	}
}

function margot_video_widgetInit() {
	register_widget('margot_video_widget');
}
add_action('widgets_init', 'margot_video_widgetInit');
// Load Widgets
include_once (get_template_directory() . '/inc/quick-flickr-widget.php');
