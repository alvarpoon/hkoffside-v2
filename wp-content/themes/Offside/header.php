 <?php
/**
 * @package margot
 * @since margot 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php $favi = of_get_option('favicon_uploader', 'no entry'); if(of_get_option('favicon_uploader', false)) { echo "<link rel=\"shortcut icon\" href=\"$favi\" />"; } ?>
<title><?php global $page, $paged; wp_title( '-', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " - $site_description"; if ( $paged >= 2 || $page >= 2 ) echo ' - ' . sprintf( __( 'Page %s', 'margot' ), max( $paged, $page ) ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
 <!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>> <div id="mrg-page">

<div id="mrg-top">
    <div class="container container-header">
        <div class="row">

            <div id="mrg-social-bar" class="col-md-3 col-md-push-9">
                <div id="mrg-logo-menu" class="hidden-xs hidden-sm sf-left">
                    <?php wp_nav_menu(array('container' => false, 'menu_id' => 'logo-menu', 'menu_class' => 'sf-menu sf-vertical', 'link_before' => '', 'theme_location' => 'logo-menu', 'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="topics-menu"><span class="top-btn-link icon-menu">'.of_get_option('logo_menu_title' , 'Menu').'</span><ul class="sub-menu"> %3$s </ul></li></ul>',)); ?>
                </div>

                <div class="mini-icons prep-content">
                    <?php margot_icons(); ?>
                </div>
            </div> 
            
            <div id="mrg-logo-bar" class="col-md-9 col-md-pull-3">
                <?php if(of_get_option('logo_uploader', false)) : ?>
                <h1 class="logo-img mrg-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php margot_custom_logo('header'); ?></a></h1>
                        <?php else: ?>
                <h1 class="logo mrg-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php endif; ?>

                <?php $margot_header_tag = of_get_option('header_tagline', false);
                if( $margot_header_tag ) { echo '<span class="site-description hidden-xs">'.$margot_header_tag.'</span>'; } ?>
            </div>

        </div>
    </div>
</div> <!-- /mrg-top -->


<div id="mrg-nav" class="mrg-top-nav">
    <div class="container container-main-nav">
        <div id="mrg-mobile-nav" class="hidden-md hidden-lg">
            <i class="icon-menu"><span class="hide">Menu</span></i>
        </div>

        <nav class="main-nav navbar-section hidden-sm hidden-xs">
            <?php wp_nav_menu(array('container' => false, 'menu_id' => 'header-menu', 'menu_class' => 'sf-menu', 'link_before' => '', 'theme_location' => 'top-menu')); ?>
        </nav>

        <div id="mrg-search-bar" class="srch-hvr">
            <div class="srch_btn icon-search"><span class="hidden"><?php _e('Go', 'margot'); ?></span></div>
            <form class="nav-search" method="get" id="searchfr" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                <label for="se" class="assistive-text"><?php _e('Search and hit', 'margot'); ?></label>
                <input type="text" class="field" name="s" id="se" placeholder="<?php _e('Search', 'margot'); ?>&hellip;" />
            </form>
        </div>
    </div>
</div> <!-- /mrg-nav -->

<div id="nn-wrap">

<?php if(of_get_option('ad_banner_uploader', false) || of_get_option('adsense_header', false)) : ?>
<div class="container mrg-unit">
    <div class="bnr-section">
    <?php if(of_get_option('ad_banner_uploader', false)) echo '<img src="'.of_get_option('ad_banner_uploader', 'no entry').'" class="img-responsive" alt="Header Unit" />'; ?>
    <?php echo of_get_option('adsense_header', false) ?>
    </div>
</div> <!-- /mrg-unit -->
<?php endif; ?>