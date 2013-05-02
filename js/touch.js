var RH = RH || {};

/**
 * State-tracking to prevent memory leaks and reapplied effects
 */
RH.inMobile = false;

/**
 * Called when entering the mobile breakpoint
 */
RH.mobileEnter = function() {
	if (RH.inMobile) {
		return;
	}
	RH.inMobile = true;
	// make nav the first element
	jQuery('nav#access').insertAfter('.global-navigation');

	RH.hideMenuOptions();
}

/**
 * Called when entering the mobile breakpoint
 */
RH.mobileEnter = function() {
	if (RH.inMobile) {
		return;
	}
	RH.inMobile = true;
	// no double click :hover for iphone
	jQuery('.main-navigation .access li').on('touchstart', function() {
		$(this).addClass('touch');
	});
	jQuery('.main-navigation .access li').on('touchmove', function() {
		$(this).removeClass('touch');
	});
	jQuery('.main-navigation .access li').on('click touchend', function() {
		$(this).removeClass('touch');
		window.location = $(this).children('a').attr('href');
	});
	// menu toggle
	jQuery('.main-navigation .mobile-menu .menu').on('click', function() {
		jQuery('.main-navigation .access').slideToggle();
	});
}

/**
 * Called when exiting the mobile breakpoint
 */
RH.mobileExit = function() {
	if (!RH.inMobile) {
		return;
	}
	RH.inMobile = false;
	jQuery('.main-navigation .mobile-menu .menu').off('click');
}