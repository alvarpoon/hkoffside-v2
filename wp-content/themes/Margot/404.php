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

                <div class="unroll"><h3 class="pretitle"><span><?php _e('Oops! That page can&rsquo;t be found.', 'margot'); ?></span></h3></div>

                <div id="mrg-main-feed">

                    <p class="alert alert-warning alert-noresults"><?php _e('It looks like nothing was found at this location. Maybe try with a search?', 'margot'); ?></p>

                    <?php get_template_part( 'searchform' ); ?>

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