<?php
/**
 * @package margot
 * @since margot 1.0
 * Template Name: Blog
 */
get_header();

?>

<div class="container container-content">
    <div id="mrg-wrap" class="omega testing">
        <div class="row"> 

            <div id="mrg-content" class="col-md-8 col-feed">

                <div class="unroll"><h3 class="pretitle"><span>Blog</span></h3></div>

                <div id="mrg-main-feed">

                    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $wp_query = new WP_Query( array( 
                                'paged' => $paged,
                                'category_name' => of_get_option('filter_cats', null),
                                /*'meta_query' => array(
                                                    array(
                                                        'key'     => 'margot_meta_featured_post',
                                                        'compare' => '',
                                                    ),
                                                )*/
                                ) );
                            while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                    <div class="extract">
                        <?php get_template_part( 'content', 'blog' ); ?>
                    </div>

                    <?php endwhile; wp_reset_postdata(); ?>

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