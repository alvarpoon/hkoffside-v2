jQuery(document).ready(function($) {
	$('#margot_meta_reviewon').click(function() {
  		$('#hidereview').fadeToggle(400);
	});
	if ($('#margot_meta_reviewon:checked').val() !== undefined) {
		$('#hidereview').show();
	}
	if($.fn.wpColorPicker !== undefined){
		$('#bgcolor, #textcolor').wpColorPicker();
	}
});


