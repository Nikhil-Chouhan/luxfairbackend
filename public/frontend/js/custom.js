(function($) {
    "use strict";
	
	/* ..............................................
	   Loader 
	   ................................................. */
	$(window).on('load', function() {
		$('.preloader').fadeOut();
		$('#preloader').delay(550).fadeOut('slow');
		$('body').delay(450).css({
			'overflow': 'visible'
		});
	});

	/* ..............................................
	   Fixed Menu
	   ................................................. */

	$(window).on('scroll', function() {
		if ($(window).scrollTop() > 50) {
			$('.main-header').addClass('fixed-menu');
			$('.navbar-brand img').attr('src', '/frontend/images/logo1.png');
			$('li.search a img').attr('src', '/frontend/images/Search_light.png');
			$('li.search1 a img').attr('src', '/frontend/images/SuperSearchIcon_Light.png');
			$('li.search2 a img').attr('src', '/frontend/images/Contact.png');
		} else {
			$('.main-header').removeClass('fixed-menu');
			// check if homepageheader is not present
			if (!$('.homepageheader').length) {

				$('.navbar-brand img').attr('src', '/frontend/images/logo.png');
				$('li.search a img').attr('src', '/frontend/images/Search_Dark.png');
				$('li.search1 a img').attr('src', '/frontend/images/SuperSearchIcon_Dark.png');
				$('li.search2 a img').attr('src', '/frontend/images/Contact_Dark.png');
			}else{
				
			$('.navbar-brand img').attr('src', '/frontend/images/logo1.png');
			$('li.search a img').attr('src', '/frontend/images/Search_light.png');
			$('li.search1 a img').attr('src', '/frontend/images/SuperSearchIcon_Light.png');
			$('li.search2 a img').attr('src', '/frontend/images/Contact.png');
			}
				


		}
	});

	/* ..............................................
	   Gallery
	   ................................................. */

	$('#slides-shop').superslides({
		inherit_width_from: '.cover-slides',
		inherit_height_from: '.cover-slides',
		play: 5000,
		animation: 'fade',
	});

	$(".cover-slides ul li").append("<div class='overlay-background'></div>");

	/* ..............................................
	   Map Full
	   ................................................. */

	$(document).ready(function() {
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		$('#back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});

	/* ..............................................
	   Special Menu
	   ................................................. */

	var Container = $('.container');
	Container.imagesLoaded(function() {
		var portfolio = $('.special-menu');
		portfolio.on('click', 'button', function() {
			$(this).addClass('active').siblings().removeClass('active');
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
				filter: filterValue
			});
		});
		var $grid = $('.special-list').isotope({
			itemSelector: '.special-grid'
		});
	});

	/* ..............................................
	   BaguetteBox
	   ................................................. */

	baguetteBox.run('.tz-gallery', {
		animation: 'fadeIn',
		noScrollbars: true
	});

	/* ..............................................
	   Offer Box
	   ................................................. */

	$('.offer-box').inewsticker({
		speed: 3000,
		effect: 'fade',
		dir: 'ltr',
		font_size: 13,
		color: '#ffffff',
		font_family: 'Montserrat, sans-serif',
		delay_after: 1000
	});

	/* ..............................................
	   Tooltip
	   ................................................. */

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});

	/* ..............................................
	   Owl Carousel Instagram Feed
	   ................................................. */

	$('.main-instagram').owlCarousel({
		loop: true,
		margin: 0,
		dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 2,
				nav: true
			},
			600: {
				items: 3,
				nav: true
			},
			1000: {
				items: 5,
				nav: true,
				loop: true
			}
		}
	});


	$('.featured-products-homepage').owlCarousel({
		loop: false,
		margin: 60,
		dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: true,
				center: true, 
			},
			600: {
				items: 3,
				nav: true,
				center: false, 
			},
			1000: {
				items: 4,
				nav: true,
				center: false,
			}
		},
		// onInitialized: function(event) {
		// 	var itemsCount = event.item.count;
		// 	if (itemsCount > 3) {
		// 		// Enable looping if items are more than 3
		// 		$('.featured-products-homepage').trigger('refresh.owl.carousel');
		// 		$('.featured-products-homepage').trigger('to.owl.carousel', 1); // Go to the second item to make sure it's not centered initially
		// 		$('.featured-products-homepage').owlCarousel('option', 'loop', true);
		// 	}
		// },
		// onChanged: function(event) {
		// 	var itemsCount = event.item.count;
		// 	if (itemsCount > 3) {
		// 		// Enable looping if items are more than 3
		// 		$('.featured-products-homepage').trigger('refresh.owl.carousel');
		// 		$('.featured-products-homepage').trigger('to.owl.carousel', 1); // Go to the second item to make sure it's not centered when transitioning
		// 		$('.featured-products-homepage').owlCarousel('option', 'loop', true);
		// 	} else {
		// 		// Disable looping if items are 3 or fewer
		// 		$('.featured-products-homepage').owlCarousel('option', 'loop', false);
		// 	}
		// }
	});
	

	/* ..............................................
	   Featured Products
	   ................................................. */

	$('.featured-products-box').owlCarousel({
		loop: false,
		margin: 15,
		dots: false,
		autoplay: false,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 3,
				nav: true
			},
			1000: {
				items: 4,
				nav: true, 
			}
		}
	});


	$('.products-gallery').owlCarousel({
		loop: false,
		margin: 15,
		dots: false,
		autoplay: false,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		navText: ["<i class='fas fa-arrow-left'></i>", "<i class='fas fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 1,
				nav: true
			},
			1000: {
				items: 1,
				nav: true, 
			}
		}
	});

	/* ..............................................
	   Scroll
	   ................................................. */

	$(document).ready(function() {
		$(window).on('scroll', function() {
			if ($(this).scrollTop() > 100) {
				$('#back-to-top').fadeIn();
			} else {
				$('#back-to-top').fadeOut();
			}
		});
		$('#back-to-top').click(function() {
			$("html, body").animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});


	/* ..............................................
	   Slider Range
	   ................................................. */

	// $(function() {
	// 	$("#slider-range").slider({
	// 		range: true,
	// 		min: 0,
	// 		max: 4000,
	// 		values: [1000, 3000],
	// 		slide: function(event, ui) {
	// 			$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
	// 		}
	// 	});
	// 	$("#amount").val("$" + $("#slider-range").slider("values", 0) +
	// 		" - $" + $("#slider-range").slider("values", 1));
	// }); 
	
	
}(jQuery));