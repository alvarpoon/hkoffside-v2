<?php
/**
 * @package margot
 * @since margot 1.0
 */
?>

<form class="form-search" method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<label for="se" class="assistive-text"><?php _e('Search and hit', 'margot'); ?></label>
	<input type="text" name="s" class="field search-query" />
	<input type="submit" name="submit" value="<?php _e('search', 'margot') ?>" class="searchsubmit rad-button" />
</form>