jQuery( document ).ready( function($) {

	"use strict";

	//Checks if li has sub (ul) and adds class for toggle icon - just an UI
	$( "#primary-menu > li:has( > ul )" ).addClass( "menu-dropdown-icon" );
	
	//Checks if drodown menu's li elements have another level (ul), if not the dropdown is shown as regular dropdown, not a mega menu (thanks Luka Kladaric)
	$( "#primary-menu > li > ul:not( :has( ul ) )" ).addClass( "normal-sub" );

	//If width is more than 767px dropdowns are displayed on hover
	$( "#primary-menu > li" ).hover( function( e ) {
		if ( $( window ).width() > 767 ) {
			$( this ).children( "ul" ).stop( true, false ).fadeToggle( 150 );
			e.preventDefault();
		}
	});
	
	//If width is less or equal to 767px dropdowns are displayed on click (thanks Aman Jain from stackoverflow)
	$( "#primary-menu > li" ).click(function() {
		if ( $( window ).width() <= 767 ) {
			$( this ).children( "ul" ).fadeToggle( 150 );
		}
	});

	//when clicked on mobile-menu, normal menu is shown as a list, classic rwd menu story (thanks mwl from stackoverflow)
	$( ".menu-toggle" ).click( function( e ) {
		$( "#primary-menu" ).toggleClass( "show-on-mobile" );
		e.preventDefault();
	});

	if ( $( '.posts-navigation .nav-links' ).children().length < 2 ) {
		$( '.nav-links' ).addClass( 'full-width' );
	} else {
		$( '.nav-links' ).addClass( 'half-width' );
	}

	/*
	* Resize the images of the grid layout on homepage
	*/
	
	var vigor_resizer = function() {
		var resizedimgwidth = 0;
		var imgratio = 0;
		var gridwidth = 0;
		var imgheight = 0;
		var largeimgheight = 0;
		var largeimgheight2 = 0;
		var leftx = 0;
		var actualimgwidth= 0;
		var actualimgheight = 0;

	};
	
	vigor_resizer();	

	$( window ).resize( function() {
		// Change during window resize
		vigor_resizer();
	});

	$( document.body ).on( 'post-load', function () {
		// New posts have been added to the page.
		vigor_resizer();
	} );

	$( '.maps' ).click( function() {
		$( '.maps iframe' ).css( 'pointer-events', 'auto' );
	});

	$( '.maps' ).mouseleave( function() {
	  $( '.maps iframe' ).css( 'pointer-events', 'none' );
	});  

	var nav = ( vigor_theme.slideshow_nav === 'true' );

	$( '.vigor-slider' ).unslider({
		delay: 5000,
		animation: vigor_theme.slideshow_animation,
		autoplay: vigor_theme.slideshow_autostart,
		nav: nav,
		arrows: nav,
	} );

	if ( $( '.unslider-arrow' )[0] ) {
		$( '.unslider-arrow.prev' ).text('').addClass( 'dashicons dashicons-arrow-left-alt2' );
		$( '.unslider-arrow.next' ).text('').addClass( 'dashicons dashicons-arrow-right-alt2' );
	}

	$(function() {
		var header = $("#masthead");
		$(window).scroll(function() {    
			var scroll = $(window).scrollTop();
		
			if (scroll >= 200) {
				header.removeClass('header').addClass("fixed");
			} else {
				header.removeClass("fixed").addClass('header');
			}
		});

		$('.add-to-cart a').click(function() {
			$(this).text('Go to cart');
			return false;
		});

	});
	

});
