jQuery(document).ready(function($) {
	$('#use_multiple_locations').click( function() {
		if( $(this).is(':checked') ) {
			$('#show-single-location').slideUp( function() {
				$('#show-multiple-locations').slideDown();	
				$('#show-opening-hours').slideUp();
			});
		}
		else {
			$('#show-multiple-locations').slideUp( function() {
				$('#show-single-location').slideDown();
				$('#show-opening-hours').slideDown();
			});
		}
	});

	$('#multiple_opening_hours, #wpseo_multiple_opening_hours').click( function() {
		if( $(this).is(':checked') ) {
			$('.opening-hours .opening-hour-second').slideDown();
		}
		else {
			$('.opening-hours .opening-hour-second').slideUp();
		}
	});



	if( $('#wpseo-checkbox-multiple-locations-wrapper').length > 0 ) {
		$('#wpseo-checkbox-multiple-locations-wrapper input[type=checkbox]').click( function() {
			var parent = $(this).parents('.widget-inside');

			if( $(this).is(':checked') ) {
				$('#wpseo-locations-wrapper', parent).slideUp();
			}
			else {
				$('#wpseo-locations-wrapper', parent).slideDown();
			}
		});
	}

	// Show locations metabox before WP SEO metabox
	if( $('#wpseo_locations').length > 0 && $('#wpseo_meta').length > 0 ) {
		$('#wpseo_locations').insertBefore( $('#wpseo_meta') );
	}
});
