(function($) {
    
    "use strict";
    
   
	$(document).ready(function(){	
        $('.mainmenu ul.menu').slicknav({
            allowParentLinks: true,
			prependTo: '.finance-responsive-menu',
        });
    }); 
    
	
	jQuery(window).load(function() {
        jQuery(".preloader-wrapper").fadeOut();
    });
	
	
	
	var amountScrolled = 300; 
	$(window).scroll(function() { 
	if ( $(window).scrollTop() > amountScrolled ) {
			$('div.back-to-top').fadeIn('slow');
		} else {
			$('div.back-to-top').fadeOut('slow');
		}
	});

	$('div.back-to-top').on('click', function() {
		$('html, body').animate({
			scrollTop: 0
		}, 700);
		return false;
	});

    
})(jQuery);