jQuery(document).ready(function($){
	// Foundation Initialization
	$(document).foundation();

	// Back-to-top
	$(".back-to-top").hide();
	// fade in back-to-top 
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
		// Top-Menu Fixed
		if ($(this).scrollTop() > 78 && windData.fixedmenu == 1 ) {
			$('#topmenu').addClass('fixed');
		} else {
			$('#topmenu').removeClass('fixed');
		}	
	});


	// Search toggle.
	$( '.search-toggle' ).on( 'click', function( event ) {
		var searchToggle    = $( this ),
			searchContainer = $( '.search-container' );

		searchToggle.toggleClass( 'active' );
		searchContainer.toggleClass( 'hide' );
		if ( searchToggle.is( '.active' ) ) {
			searchContainer.find( '.search-query' ).focus();
		}
	} );
	
	$( '.search-container .search-query' ).focusout(function( event ) {
		var searchToggle    = $( '.search-toggle' ),
			searchContainer = $( '.search-container' );		
		searchToggle.removeClass( 'active' );
		searchContainer.addClass( 'hide' );
	} );
			
	// scroll body to 0px on click
	$('.back-to-top a').click(function () {
		$('body,html,header').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
// Slider
	if ( $('.windTicker').length !== 0 ) {
		$('.windTicker').bxSlider({
  			minSlides: windTicker.minSlides,
  			maxSlides: windTicker.maxSlides,
  			slideWidth: windTicker.slideWidth,
  			slideMargin: 20,
  			ticker: true,
  			speed: windTicker.speed * 1000,
  			tickerHover: true,
  			useCSS: false,
		});
	}
	if ( $('.windSlider').length !== 0 ) {
		$('.windSlider').bxSlider({
			auto: true,
			mode: windSlider.mode,
			pause: windSlider.speed * 1000,
			speed: 1000,
		});
	}
	//Adjust Header
	function adjust_header() {
		var  hwHeight = $(".site-header").outerHeight( false ) - 38;
		if  ( $('.fullwidth-slider .featured-content').length > 0 && hwHeight > 0 ) {
			var sliderHeight = $(".fullwidth-slider .bx-wrapper").outerHeight( false );
			sliderHeight = sliderHeight - hwHeight;
			var cssStr = '-' + hwHeight + 'px';
			$(".fullwidth-slider .featured-content").css("top",cssStr);
			var cssStr = sliderHeight + 'px';
			$(".fullwidth-slider .featured-content").css("height",cssStr);		
		}
	}

	$(window).resize(function() {
		adjust_header();
	});
	adjust_header();
});
