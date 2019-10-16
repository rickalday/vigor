/**
* -----------------------------------------------------------------------------
* Initializes & sets up Google Fonts Live Preview JS 
* =============================================================================

*/

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.home .site-title a, .home .site-description, .home .main-navigation a, .front-page-content, .front-page-content a.button' ).css( {
					'color': to,
				} );
				$( '.front-page-content a.button' ).css( {
					'border-color': to,
				} );
			}
		} );
	} );
	
} )( jQuery );