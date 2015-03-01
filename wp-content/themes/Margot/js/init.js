jQuery(document).ready(function($) {


// Owl Carousel init
// ===============================================================================

	var owl_widget_slider = jQuery('.yk-slider');
	owl_widget_slider.owlCarousel({ // ==================== Widget Slider
		responsiveRefreshRate: 10,
		navigation: true,
		pagination: false,
		autoHeight: false,
		transitionStyle: "fade",
		itemSpaceWidth: 6,
		items: 1,
		itemsDesktop: [1200, 1],
		itemsDesktopSmall: [976, 2],
		itemsTablet: [740, 2],
	});

	var owl_gallery_slider = jQuery('.ss-slider');
	owl_gallery_slider.owlCarousel({ // ==================== Gallery Slider
		responsiveRefreshRate: 10,
		navigation: true,
		pagination: false,
		autoHeight: true,
		items: 1,
		itemsDesktop: [1200, 1],
		itemsDesktopSmall: [991, 1],
		itemsTablet: [740, 1],
		itemsMobile: false,
		afterInit: function(elem) {
			jQuery('.single-gallery').removeClass('loading');
		}
	});

	var owl_media = jQuery('.media-panel .owl-carousel');
	owl_media.owlCarousel({ // ============ Carousel Posts
		responsiveRefreshRate: 10,
		navigation: true,
		pagination: false,
		items: 4,
		itemSpaceWidth: 8,
		itemsDesktop: [1200, 4],
		itemsDesktopSmall: [976, 2],
		itemsTablet: [740, 2],
		itemsMobile: [480, 1]
	});

	var owl_related = jQuery('.sc-panels');
	owl_related.owlCarousel({ // ============ Related Posts
		responsiveRefreshRate: 10,
		navigation: true,
		pagination: false,
		items: 3,
		itemSpaceWidth: 6,
		itemsDesktop: [1200, 3],
		itemsDesktopSmall: [991, 2],
		itemsTablet: [740, 1],
		itemsMobile: false
	});


// Fixed Menubar
// ===============================================================================
	if (jQuery('body').hasClass('sticky-nav') && jQuery('.mrg-top-nav').length ) {
		var asideTop = jQuery('.mrg-top-nav').offset().top;
		var extraTop = jQuery('body').hasClass('extra-top') ? 30 : 0;
		jQuery(window).scroll(function() {
			var asideY = jQuery(this).scrollTop();
			if (asideY >= asideTop-extraTop) {
				jQuery('#nn-wrap').addClass('top-wrap');
				jQuery('.mrg-top-nav').addClass('append');
			} else {
				jQuery('#nn-wrap').removeClass('top-wrap');
				jQuery('.mrg-top-nav').removeClass('append').removeAttr('style');
			}
		});
	}


// Display Comments
// ===============================================================================
	jQuery(".load-comments").click(function() {
		jQuery(".up-comments").removeClass('hidden-comments');
	});

	jQuery(".load-comments").toggle(function() {
		jQuery(".up-comments").fadeIn("slow");
	}, function() {
		jQuery(".up-comments").fadeOut("slow");
	});


// dotdotdot
// ===============================================================================
	jQuery(".media-panel h2").dotdotdot({
		ellipsis: '...',
		height:76,
		wrap: 'word',
		fallbackToLetter: false,
		watch: true
	});

	jQuery(".extract .entry-content p").dotdotdot({
		ellipsis: '...',
		height:120,
		wrap: 'word',
		fallbackToLetter: false,
		watch: true
	});


// Sidr
// ===============================================================================
	jQuery('#toggle-link').sidr({
		speed: 100,
		source: '.main-nav',
		onOpen: function() {
			jQuery("#sidr .sidr-inner").prepend( jQuery( ".prep-content" ) );
			jQuery('#mrg-page').click(function() {
				jQuery.sidr('close');
			});
			jQuery(window).resize(function() {
				jQuery.sidr('close');	
			});
    	},
    	onClose: function() {
			jQuery(".prep-content").appendTo( "#mrg-social-bar" );
    	}
	});
	jQuery('#mrg-mobile-nav').on('click', function(){
		jQuery('#sidr a').addClass('ui-disabled').attr('disabled','disabled');
		jQuery.sidr('toggle', 'sidr', function(){
			jQuery('#sidr a').removeClass('ui-disabled').removeAttr('disabled');
		});
	});

	jQuery('#mrg-search-bar').removeClass('srch-hvr');
	jQuery('#mrg-search-bar').on('hover', function(){
		jQuery(this).toggleClass("active");
	});

// Tooltip 
// ===============================================================================
	jQuery('a[data-toggle="tooltip"]').tooltip();


// Superfish Menu
// ===============================================================================
	jQuery('#header-menu, #footer-menu, #logo-menu').superfish({
		delay: 200,
	});

// Share Buttons
// ===============================================================================
	jQuery('a.share-fb, a.share-tw').on('click', function() {
		var newwindow = window.open(jQuery(this).attr('href'), '', 'width=626,height=436');
		if (window.focus) {
			newwindow.focus();
		}
		return false;
	});

// Knob
// ===============================================================================
	function inknob() {
		var knoboptions = {
			min: 1,
			max: 100,
			readOnly: true,
			fgColor: "#eee",
			bgColor: "transparent",
			inputColor: "#fff",
			thickness: ".14",
			font: "Roboto",

		};
		jQuery(".dial").knob(knoboptions);
		jQuery(".ubscore input").fadeIn();
	}
	inknob();

// FitVids
// ===============================================================================
	jQuery(".wg-video").fitVids();


// Gallery & Video position
// ===============================================================================
	jQuery(".format-video .video-in").appendTo("#mrg-featured-media");
	jQuery(".format-video .entry-content .video-in").eq(0).appendTo("#mrg-featured-media");
	jQuery(".format-audio .wp-audio-shortcode").eq(0).appendTo( "#mrg-featured-media" );
	jQuery(".format-audio .wp-playlist").eq(0).appendTo( "#mrg-featured-media" );


// Col
// ===============================================================================
	jQuery("#collapse1").addClass("in");

// Tabs
// ===============================================================================
	jQuery("ul.nav-tabs li:first").addClass("active"); //Activate first tab
	jQuery("div.tab-content div:first").addClass("active"); //Show first tab content
	jQuery("ul.nav-tabs li").click(function() {
		jQuery("ul.nav-tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		var activeTab = jQuery(this).find("a").attr("href");
		jQuery("div.tab-content div").removeClass("active"); //Hide all tab content
		jQuery('div.tab-content #' + activeTab).addClass("active"); //Fade in the active ID content
		return false;
	});


// Overlay
// ===============================================================================
	if ( jQuery(window).width() < 767 ) {
        jQuery(".container-featured-posts").removeClass('active-ov');
    }
	jQuery(".active-ov #mrg-featured-area .mrg-item").hover(function() {
		jQuery(".mrg-chroma", this).fadeOut();
	}, function() {
		jQuery(".mrg-chroma", this).fadeIn("slow");
	});


// Animate Progress Bar inview
// ===============================================================================

	jQuery(".progress").on("inview",function(){
		jQuery(".progress-bar-info").each(function() {
			jQuery(this).removeClass('unwidth').data("origWidth", jQuery(this).width()).width(0)
			.animate({
				width: jQuery(this).data("origWidth")
			}, 2200);

		});
		jQuery(".progress").off("inview");

		setTimeout(function(){
			jQuery('.base-sc').fadeIn();
		}, 2000);
	});


// Infinite Scroll
// ===============================================================================

	if(jQuery.fn.infinitescroll !== undefined){
	jQuery('#mrg-main-feed').infinitescroll({
		contentSelector:"#mrg-main-feed",  
		itemSelector : ".extract",
		nextSelector: ".nav-load a",
		navSelector: ".site-navigation",
		behavior: "twitter",
		loading: {
			img: mrgvars.loadingimg,
			msgText:  "<em>"+mrgvars.loadmsg+"</em>",
			finishedMsg: "<em>"+mrgvars.nomsg+"</em>",
		},
	},
	function(newElements){
		inknob();
	});
	}


// Facebook Plugin
// ===============================================================================
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) { return; }
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}  (document, 'script', 'facebook-jssdk'));


});