<?php

/**
 * @package margot
 * @since margot 1.0
 */
?>

<!-- ============================= Footer Container -->
<div id="footer">
	<div class="container footer-container">

		<nav class="btm-nav">
		<?php wp_nav_menu(array('container' => false, 'menu_id' => 'footer-menu', 'theme_location' => 'footer-menu', 'menu_class' => 'sf-menu', 'after' => ' ',)); ?>
		</nav>

		<div id="mrg-footer" class="omega">
			<div class="row footer-cols">
			<?php get_template_part('sidebar-footer'); ?>
			</div>
		</div>
	</div>
</div>
<!-- ============================= /Footer Container -->

 <!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/excanvas.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->

<?php echo of_get_option('ga_code', 'no_entry'); ?>

<?php wp_footer(); ?>

</div>
</div>

</body> 
</html>