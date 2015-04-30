/**
 * Customizwer Scripts
 * 
 * @package	wind
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
( function( $ ) {

	// Diable fonts that are not selectable.
	$('#customize-control-wind_options-bodyfont option')
		.filter(function(index) {
			var val = $(this).val();
			return !isNaN(parseFloat(+val)) && isFinite(val);
		}).attr('disabled', 'disabled');
	
} )( jQuery );
