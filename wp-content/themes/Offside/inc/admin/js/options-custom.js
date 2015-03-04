/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */
jQuery(document).ready(function($) {
	$('#set_bg').click(function() {
		$('#section-set_boxed').fadeToggle(400);
		$('#section-bg_opt').fadeToggle(400);
		$('#section-bg_responsive').fadeToggle(400);
		$('#section-bg_overlay').fadeToggle(400);
	});
	$('#set_retina').click(function() {
		$('#section-re_logo_uploader').fadeToggle(400);
		$('#section-re_logo_uploader_footer').fadeToggle(400);
	});

	$('#mrg_featured_area').click(function() {
		$('#section-featured_title').fadeToggle(400);
		$('#section-filter_featured_format').fadeToggle(400);
		$('#section-filter_featured_cats').fadeToggle(400);
		$('#section-featured_posts_number').fadeToggle(400);
		$('#section-mrg_color_overlay').fadeToggle(400);
	});


	$('#mrg_carousel_posts').click(function() {
		$('#section-carousel_title').fadeToggle(400);
		$('#section-filter_carousel_format').fadeToggle(400);
		$('#section-filter_carousel_cats').fadeToggle(400);
	});
	if ($('#set_bg:checked').val() !== undefined) {
		$('#section-set_boxed').show();
		$('#section-bg_opt').show();
		$('#section-bg_responsive').show();
		$('#section-bg_overlay').show();
	}
	if ($('#set_retina:checked').val() !== undefined) {
		$('#section-re_logo_uploader').show();
		$('#section-re_logo_uploader_footer').show();
	}
	if ($('#mrg_featured_area:checked').val() !== undefined) {
		$('#section-featured_title').show();
		$('#section-filter_featured_format').show();
		$('#section-filter_featured_cats').show();
		$('#section-featured_posts_number').show();
		$('#section-mrg_color_overlay').show();
	}
	if ($('#mrg_carousel_posts:checked').val() !== undefined) {
		$('#section-carousel_title').show();
		$('#section-filter_carousel_format').show();
		$('#section-filter_carousel_cats').show();
	}
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	$('.of-color').wpColorPicker();
	$('.of-color').iris({
		hide: false,
		palettes: ["#673055", "#CF4647", "#FFA200", "#111111", "#FE7C7C", "#3D9347", "#CBB090", "#223B5E", "#ffffff"]
	});
	// Switches option sections
	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined') {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length) {
		$(active_tab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function() {
		$(this).find('input:checked').parent().parent().parent().nextAll().each(function() {
			if ($(this).hasClass('last')) {
				$(this).removeClass('hidden');
				return false;
			}
			$(this).filter('.hidden').removeClass('hidden');
		});
	});
	if (active_tab != '' && $(active_tab + '-tab').length) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	} else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined') {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if (editor_iframe.height() < 30) {
				editor_iframe.css({
					'height': 'auto'
				});
			}
		});
	});
	$('.group .collapsed input:checkbox').click(unhideHidden);

	function unhideHidden() {
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		} else {
			$(this).parent().parent().parent().nextAll().each(function() {
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;
				}
				$(this).addClass('hidden');
			});
		}
	}
	// Image Options
	$('.of-radio-img-img').click(function() {
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
});