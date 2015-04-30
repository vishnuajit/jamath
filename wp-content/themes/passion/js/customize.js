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

	wp.customize( 'wind_options[showauthor]', function( value ) {
		value.bind( function( newval ) {
			if ( newval )
				$('.by-author').css('display', 'inline' );
			else
				$('.by-author').css('display', 'none' );
		} );
	} );
	
} )( jQuery );
