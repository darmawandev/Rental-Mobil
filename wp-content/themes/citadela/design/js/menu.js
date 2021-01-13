
jQuery(document).ready(function(){
	"use strict";
	

	citadelaMainMenuBurgerPrepare();
	citadelaMainMenuBurger();
	citadelaResponsiveMenuCloseBtn();
	citadelaSubmenuManagement();
	citadelaMainMenuScroll();
});

/* Window Resize Hook */
jQuery(window).resize(function(){

	citadelaMainMenuBurger();
	citadelaSubmenuManagement();
	citadelaMainMenuScroll();
});


function citadelaResponsiveMenuCloseBtn() {
	var $navContainer = jQuery('nav#site-navigation');
	$navContainer.find('.citadela-menu-container').prepend('<span class="responsive-close-button"></span>');
	var $responsiveCloseButton = $navContainer.find('.responsive-close-button')

	$responsiveCloseButton.on('click', function(e){
		var $liWrapper = jQuery(this).siblings('ul.citadela-menu').find('li.menu-item-wrapper');
		citadelaSubmenuClickAction( $liWrapper );
	});

}

function citadelaMainMenuScroll(){
	var header = document.getElementById('masthead');
	var $body = jQuery('body');
	var waypoint = new Waypoint({
	  element: header,
	  handler: function(direction) {
	    switch (direction) {
		  case 'up':
		    //scrolling from down to up
		    $body.removeClass('header-scrolled');
		  	break;
		  case 'down':
		    //scrolling from up to down
		    $body.addClass('header-scrolled');
		  	break;
		  default:
		  	return;
		}
	  },
	  offset: function() {
	    return -this.element.clientHeight;
	  }
	})
}

function citadelaSubmenuManagement(){
	var isResponsive = jQuery('body').hasClass('responsive-menu');
	var menuArrow = '<span class="submenu-arrow"></span>';
	var $navContainer = jQuery('nav#site-navigation');
	var $mainMenuUl = $navContainer.find('.citadela-menu-container').find('ul.citadela-menu');

	$mainMenuUl.find('li.menu-item-has-children').each(function(){
		var $li = jQuery(this);
		if( $li.hasClass("menu-item-wrapper") ) return;
		//create submenu arrows
		if( ! $li.children('span.submenu-arrow').length ) $li.append(menuArrow);
		
		//apply click for submenu arrow
		$li.children('span.submenu-arrow').off();
		$li.children('span.submenu-arrow').on('click', function(e){
			var $arrow = jQuery(this);
			var $clickedLi = $arrow.parent('li');
			citadelaSubmenuClickAction( $clickedLi );
		});

		//apply click for custom menu item with empty link or link to #
		if($li.hasClass('menu-item-type-custom')){
			var $a = $li.children('a');
			if(!$a.attr('href') || $a.attr('href') == '#'){
				$a.off();
				$a.on('click', function(e){
					e.preventDefault();
					var $clickedLi = $a.parent('li');
					citadelaSubmenuClickAction( $clickedLi );
				});
				
			}
		}

	});


	var $menuItemWrapper = $mainMenuUl.children('li.menu-item-wrapper');

	$menuItemWrapper.off();
	$menuItemWrapper.children('a').off();

	if( isResponsive ){
		//apply events in responsive
		$menuItemWrapper.children('a').on( 'click', function(e){
			e.preventDefault();
		});
		$menuItemWrapper.children('a').on( 'mousedown', function(e){
			citadelaSubmenuClickAction( jQuery(this).parent('li') );
		});
		$menuItemWrapper.focusin(function(){
			jQuery('body').addClass('menu-opened');
		});
		$menuItemWrapper.focusout(function(){
			if( jQuery(this).hasClass('opened') ) return;
			jQuery('body').removeClass('menu-opened');
		});
	}else{
		$menuItemWrapper.children('a').on( 'click', function(e){
			e.preventDefault();
			citadelaSubmenuClickAction( jQuery(this).parent('li') );
		})
		
	}


}


function citadelaSubmenuClickAction( $li ){
	var $clickedLi = $li,
		$body = jQuery('body');

	if($clickedLi.hasClass('opened')){

		if( $clickedLi.hasClass("menu-item-wrapper") || $clickedLi.hasClass("menu-item-type-custom") ){
			//remove focus after click on opened wrapper menu
			$clickedLi.children('a').blur();
		}

		$clickedLi.removeClass('opened');
		$clickedLi.children('ul.sub-menu').removeClass('opened');
		//close all child nodes
		$clickedLi.find('li.opened').removeClass('opened');
		$clickedLi.find('ul.sub-menu.opened').removeClass('opened');

		//body class for opened responsive menu
		if( $clickedLi.hasClass('menu-item-wrapper') && $body.hasClass('responsive-menu') ){
			$body.removeClass('menu-opened');
		}
	}else{
		citadelaCloseAllSiblingTopLevelItems( $clickedLi );
		$clickedLi.addClass('opened');
		$clickedLi.children('ul.sub-menu').addClass('opened');

		//body class for opened responsive menu
		if( $clickedLi.hasClass('menu-item-wrapper') && $body.hasClass('responsive-menu') ){
			$body.addClass('menu-opened');
		}
	}

}
	
function citadelaCloseAllSiblingTopLevelItems( $li ){
	var $clickedLi = $li;
	var $sibling;
	$clickedLi.siblings('.top-level-menu-item.opened').each(function(){
		$sibling = jQuery(this);
		$sibling.removeClass('opened');
		$sibling.find('li.opened').removeClass('opened');
	});
}

function citadelaGetMenuAdditions(){
	//selectors of parts displayed in navigation place
	return [ 
		'.citadela-woocommerce-minicart' 
	];
}

function citadelaGetMenuAvailableWidth(){
	var $navContainer = jQuery('nav#site-navigation');
	var $burgerMenuWrapper = $navContainer.find('li.menu-item-wrapper');

	var headerAdditions = citadelaGetMenuAdditions();
	
	var navWidth = $navContainer.width();

	var availableWidth = navWidth;

	jQuery.each( headerAdditions , function( $key, $value ){
		var w = jQuery( $value ).outerWidth(true);
		
		availableWidth = availableWidth - w;
	});

	return Math.floor( availableWidth );
}

function citadelaMainMenuBurgerPrepare(){
	var $navContainer = jQuery('nav#site-navigation');

	// menu items widths
	var $menuContainer = $navContainer.find('ul.citadela-menu');
	var widthLiAll = 0,
		widthLi = 0;
	$menuContainer.children('li').each(function(pos){
		jQuery(this).addClass('menu-item-position-' + pos);
		if( ! citadela_isResponsive( citadela_emToPx( "37.5" ) ) ){
			//calculate sizes only for desktop design, in responsive design is li size = 0
			widthLi = jQuery(this).outerWidth(true);
			jQuery(this).attr('data-width', widthLi);
			widthLiAll += widthLi;
		}
	});
	$menuContainer.attr('data-liWidth', widthLiAll);

	// append burger li .. burger is always created
	var hamburgerHtml = '<i class="fa fa-bars"></i>';
	$menuContainer.append('<li class="menu-item-wrapper menu-item-has-children sub-menu-right-position top-level-menu-item"><a href="#">' + hamburgerHtml + '</a><ul class="sub-menu"></ul></li>');
	var $burgerMenuWrapper = $menuContainer.find('li.menu-item-wrapper');
	var $burgerMenuContainer = $burgerMenuWrapper.find('.sub-menu');
	
	// fill up burger menu with data
	var $menuContainerChildren = $menuContainer.children('li:not(.menu-item-wrapper)').clone(true);
	$menuContainerChildren.appendTo($burgerMenuContainer);
	
	$burgerMenuWrapper.find('li').each(function(){
		jQuery(this).addClass('menu-item-cloned');
	});
	
	// add new classes
	$burgerMenuContainer.find('li').each(function(){
		if(jQuery(this).children('ul').length > 0){
			jQuery(this).addClass('menu-item-has-children');
		}
	});

	var burgerMenuItemWidth = $burgerMenuWrapper.outerWidth();
	
	var availableWidth = citadelaGetMenuAvailableWidth();

	$navContainer.attr('data-availablespace', availableWidth );
	$navContainer.attr('data-burgerspace', burgerMenuItemWidth);
	
	availableWidth = availableWidth - burgerMenuItemWidth;	

	// will the burger be shown by default
	if(availableWidth < widthLiAll){
		$burgerMenuWrapper.css({'display': 'inline-block'});
	} else {
		$burgerMenuWrapper.css({'display': 'none'});
	}

	// reset all styles added by script
	$navContainer.removeClass('menu-hidden');
}

function citadelaMainMenuBurger(){
	var $navContainer = jQuery('nav#site-navigation');
	var $menuContainer = $navContainer.find('.citadela-menu');
	


	
	if( ! citadela_isResponsive( citadela_emToPx( "37.5" ) ) ) {
		//desktop design
		//remove body class for responsive menu
		jQuery('body').removeClass('responsive-menu menu-opened');
		
		citadelaCloseAllTopItemsSubmenus();
		
		//calculate real size of menu li items after screen change
		// - necessary after move from responsive to desktop design
		var widthLiAll = 0,
			widthLi = 0;
		$menuContainer.children('li:not(.menu-item-wrapper)').each(function(pos){
			widthLi = jQuery(this).outerWidth(true);
			jQuery(this).attr('data-width', widthLi);
			widthLiAll += widthLi;
		});
		$menuContainer.attr('data-liWidth', widthLiAll);
		
		// update available space
		var headerAdditions = citadelaGetMenuAdditions();
		var widthNav = $navContainer.width();
		var availableSpace = widthNav;
		jQuery.each( headerAdditions , function($key, $value ){
			var w = jQuery( $value ).outerWidth(true);
			availableSpace = availableSpace - w;
		});
		var $wooCart = jQuery('.citadela-woocommerce-minicart');


		var availableWidth = citadelaGetMenuAvailableWidth();

		$navContainer.attr('data-availablespace', Math.floor( availableWidth) );

		var $burgerMenuWrapper = $menuContainer.find('li.menu-item-wrapper');
		
		$burgerMenuWrapper.show();

		var burgerMenuItemWidth;
		burgerMenuItemWidth = parseInt($navContainer.attr('data-burgerspace'));
		
		availableWidth = availableWidth - burgerMenuItemWidth;
		
		if(parseInt($menuContainer.attr('data-liWidth')) > Math.floor( availableWidth )){
			// the menu is bigger than available width in menu container
			var fittingWidth = availableWidth;
			$menuContainer.children('li:not(.menu-item-wrapper)').each(function(pos){
				// for every li, get his width and try to fit it
				var liWidth = parseInt(jQuery(this).attr('data-width')) == 0 ? jQuery(this).outerWidth(true) : parseInt(jQuery(this).attr('data-width'));
				fittingWidth = parseInt(fittingWidth - liWidth);
				if(fittingWidth > 0){
					// no problem .. li fits
					jQuery(this).show();
					jQuery(this).addClass('top-level-menu-item');
					// hide in the wrapmenu
					$menuContainer.find('.menu-item-cloned.menu-item-position-' + pos).hide().removeClass('opened');
				} else {
					// problem .. li doesnt fit
					jQuery(this).hide();
					jQuery(this).removeClass('top-level-menu-item opened');
					// show in the wrapmenu
					$menuContainer.find('.menu-item-cloned.menu-item-position-' + pos).show();
				}
			});
			$menuContainer.find('.menu-item-wrapper').css({'display': 'inline-block'});
		} else {
			var fittingWidth = availableWidth;
			$menuContainer.children('li:not(.menu-item-wrapper)').each(function(pos){
				var liWidth = parseInt(jQuery(this).attr('data-width')) == 0 ? jQuery(this).width() : parseInt(jQuery(this).attr('data-width'));
				fittingWidth = parseInt(fittingWidth - liWidth);
				if(fittingWidth > 0){
					// no problem .. li fits
					jQuery(this).show();
					jQuery(this).addClass('top-level-menu-item');
					// hide in the wrapmenu
					$menuContainer.find('.menu-item-cloned.menu-item-position-' + pos).hide();
				}
			});
			// hide wrapping menu
			$menuContainer.find('.menu-item-wrapper').css({'display': 'none'});
		}

	}else{
		//responsive design
		//add body class for responsive menu
		jQuery('body').addClass('responsive-menu');
		$menuContainer.attr('data-liWidth', 0);
		$menuContainer.find('.menu-item-wrapper').css({'display': 'inline-block'});
		$menuContainer.children('li:not(.menu-item-wrapper)').each(function(pos){
			jQuery(this).hide();
			$menuContainer.find('.menu-item-cloned.menu-item-position-' + pos).show();
		});
	}
}

function citadelaCloseAllTopItemsSubmenus(){
	$mainMenuUl = jQuery('#masthead').find('.citadela-menu-container').find('ul.citadela-menu');
	$menuItemWrapper = $mainMenuUl.find('li.menu-item-wrapper');
	if($menuItemWrapper.hasClass('opened')){
		$mainMenuUl.find('li.opened.top-level-menu-item:not(.menu-item-wrapper)').each(function(){
			jQuery(this).removeClass('opened');
		});
	}
}